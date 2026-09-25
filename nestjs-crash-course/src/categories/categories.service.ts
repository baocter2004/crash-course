import { Injectable, NotFoundException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Category } from './enities/category.entity';
import { Repository } from 'typeorm';
import { PaginationQueryDto } from 'src/common/dto/pagination-query.dto';
import { Paginated } from 'src/common/pagination';
import { CreateCategoryDto } from './dto/create-category.dto';
import { UpdateCategoryDto } from './dto/update-category.dto';

@Injectable()
export class CategoriesService {
  constructor(
    @InjectRepository(Category)
    private readonly categoriesRepository: Repository<Category>,
  ) {}

  async findAll(query: PaginationQueryDto): Promise<Paginated<Category>> {
    const { page, limit } = query;
    const [rows, total] = await this.categoriesRepository
      .createQueryBuilder('category')
      .loadRelationIdAndMap('category.productsCount', 'category.products')
      .orderBy('category.id', 'DESC')
      .skip((page - 1) * limit)
      .take(limit)
      .getManyAndCount();

    const data = rows.map((category) => ({
      ...category,
      productsCount:
        (category.productsCount as unknown as number[])?.length ?? 0,
    }));

    return {
      data,
      meta: { total, page, limit, totalPages: Math.ceil(total / limit) },
    };
  }

  async findOne(id: number): Promise<Category> {
    const category = await this.categoriesRepository.findOne({
      where: { id },
      relations: { products: true },
    });

    if (!category) {
      throw new NotFoundException(`Categories with id ${id} not found!`);
    }

    return category;
  }

  create(data: CreateCategoryDto): Promise<Category> {
    const category = this.categoriesRepository.create(data);
    return this.categoriesRepository.save(category);
  }

  async update(id: number, data: UpdateCategoryDto): Promise<Category> {
    const category = await this.findOne(id);
    Object.assign(category, data);
    return this.categoriesRepository.save(category);
  }

  async remove(id: number): Promise<void> {
    const category = await this.findOne(id);
    await this.categoriesRepository.remove(category);
  }
}
