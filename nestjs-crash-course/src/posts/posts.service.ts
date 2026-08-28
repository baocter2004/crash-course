import { Injectable, NotFoundException } from '@nestjs/common';
import { CreatePostDto } from './dto/create-post.dto';
import { UpdatePostDto } from './dto/update-post.dto';

interface Post {
  id: number;
  title: string;
  body: string;
}

@Injectable()
export class PostsService {
  private posts: Post[] = [
    { id: 1, title: 'Post One', body: 'This is post one' },
    { id: 2, title: 'Post Two', body: 'This is post two' },
    { id: 3, title: 'Post Three', body: 'This is post three' },
  ];

  findAll(): Post[] {
    return this.posts;
  }

  findOne(id: number): Post {
    const post = this.posts.find((p) => p.id === id);
    if (!post) {
      throw new NotFoundException(`Post with id ${id} not found`);
    }
    return post;
  }

  create(data: CreatePostDto): Post {
    // KHÔNG dùng length + 1: sau khi xoá bản ghi giữa mảng sẽ sinh ID trùng.
    // Lấy max(id) + 1 để ID luôn là duy nhất.
    const nextId = this.posts.length
      ? Math.max(...this.posts.map((p) => p.id)) + 1
      : 1;

    const newPost: Post = {
      id: nextId,
      ...data,
    };

    this.posts.push(newPost);
    return newPost;
  }

  update(id: number, data: UpdatePostDto): Post {
    const index = this.posts.findIndex((p) => p.id === id);
    if (index === -1) {
      throw new NotFoundException(`Post with id ${id} not found`);
    }
    this.posts[index] = { ...this.posts[index], ...data };
    return this.posts[index];
  }

  remove(id: number): void {
    const index = this.posts.findIndex((p) => p.id === id);
    if (index === -1) {
      throw new NotFoundException(`Post with id ${id} not found`);
    }
    this.posts.splice(index, 1);
  }
}
