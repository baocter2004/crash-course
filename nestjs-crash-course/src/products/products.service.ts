import { ProductQueryDto } from './dto/get-product.dto';
import { Paginated } from './../common/pagination';
import { Injectable, NotFoundException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Product } from './enities/product.entity';
import { Repository } from 'typeorm';
import { CreateProductDto } from './dto/create-product.dto';
import { Category } from 'src/categories/enities/category.entity';

@Injectable()
export class ProductsService {
  constructor(
    @InjectRepository(Product)
    private readonly productsRepository: Repository<Product>,
    @InjectRepository(Category)
    private readonly categoriesRepository: Repository<Category>,
  ) {}

  async findAll(query: ProductQueryDto): Promise<Paginated<Product>> {
    const { page, limit, search, categoryId } = query;
    // const [data, total] = await this.productsRepository.findAndCount({
    //   skip: (page - 1) * limit,
    //   take: limit,
    //   order: { id: 'DESC' },
    //   relations: {
    //     category: true,
    //   },
    // });

    const qb = this.productsRepository
      .createQueryBuilder('product')
      .leftJoin('product.category', 'category')
      .orderBy('product.id', 'DESC')
      .skip((page - 1) * limit)
      .take(limit);

    if (search) {
      qb.andWhere('product.name LIKE :search', {
        search: `%${search}%`,
      });
    }

    if (categoryId) {
      qb.andWhere('category.id = :categoryId', {
        categoryId,
      });
    }

    const [data, total] = await qb.getManyAndCount();

    return {
      data,
      meta: {
        total,
        page,
        limit,
        totalPages: Math.ceil(total / limit),
      },
    };
  }

  async findOne(id: number): Promise<Product> {
    const product = await this.productsRepository.findOne({
      where: { id },
      relations: { category: true },
    });

    if (!product) {
      throw new NotFoundException(`Products with id ${id} not found`);
    }

    return product;
  }

  async create(dto: CreateProductDto): Promise<Product> {
    const category = await this.categoriesRepository.findOneBy({
      id: dto.categoryId,
    });

    if (!category) {
      throw new NotFoundException('Category not found');
    }

    const product = this.productsRepository.create({
      ...dto,
      category,
    });

    return this.productsRepository.save(product);
  }
}
