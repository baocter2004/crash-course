import { Injectable, NotFoundException } from '@nestjs/common';
import { CreatePostDto } from './dto/create-post.dto';
import { UpdatePostDto } from './dto/update-post.dto';
import { InjectRepository } from '@nestjs/typeorm';
import { Post as PostEntity } from './entities/post.entity';
import { DataSource, Repository } from 'typeorm';
import { PaginationQueryDto } from 'src/common/dto/pagination-query.dto';
import { Paginated } from 'src/common/pagination';
import { Comment } from 'src/comments/entities/comment.entity';

@Injectable()
export class PostsService {
  constructor(
    @InjectRepository(PostEntity)
    private readonly postsRepository: Repository<PostEntity>,
    private readonly dataSource: DataSource,
  ) {}

  async findAll(query: PaginationQueryDto): Promise<Paginated<PostEntity>> {
    const { page, limit } = query;
    const [data, total] = await this.postsRepository.findAndCount({
      skip: (page - 1) * limit,
      take: limit,
      order: { id: 'DESC' },
    });

    return {
      data,
      meta: { total, page, limit, totalPages: Math.ceil(total / limit) },
    };
  }

  async findOne(id: number): Promise<PostEntity> {
    const post = await this.postsRepository.findOne({
      where: { id },
      relations: { comments: true },
    });
    if (!post) {
      throw new NotFoundException(`Post with id ${id} not found`);
    }
    return post;
  }

  create(data: CreatePostDto): Promise<PostEntity> {
    const post = this.postsRepository.create(data);
    return this.postsRepository.save(post);
  }

  async update(id: number, data: UpdatePostDto): Promise<PostEntity> {
    const post = await this.findOne(id);
    Object.assign(post, data);
    return this.postsRepository.save(post);
  }

  async remove(id: number): Promise<void> {
    const post = await this.findOne(id);
    await this.postsRepository.remove(post);
  }

  async createWithWelcomeComment(dto: CreatePostDto): Promise<PostEntity> {
    return this.dataSource.transaction(async (manager) => {
      const post = await manager.save(PostEntity, dto);
      await manager.save(Comment, {
        content: 'chào mừng bài viết đầu tiên!',
        post,
      });
      return post;
    });
  }

  async createWithWelcomeCommentManual(
    dto: CreatePostDto,
  ): Promise<PostEntity> {
    const queryRunner = this.dataSource.createQueryRunner();
    await queryRunner.connect(); // lấy 1 connection riêng
    await queryRunner.startTransaction(); // BEGIN

    try {
      const post = await queryRunner.manager.save(PostEntity, dto);
      await queryRunner.manager.save(Comment, {
        content: 'chào mừng bài viết đầu tiên! (manual)',
        post,
      });
      await queryRunner.commitTransaction(); // commit - chỉ khi ko lỗi gì
      return post;
    } catch (err) {
      await queryRunner.rollbackTransaction(); // roll back
      throw err;
    } finally {
      await queryRunner.release(); // luôn chạy
    }
  }
}
