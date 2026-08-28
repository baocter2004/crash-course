import { Injectable } from '@nestjs/common';

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

  findOne(id: number): Post | undefined {
    return this.posts.find((p) => p.id === id);
  }

  create(data: Omit<Post, 'id'>): Post {
    const newPost: Post = {
      id: this.posts.length + 1,
      ...data,
    };

    this.posts.push(newPost);
    return newPost;
  }

  update(id: number, data: Partial<Post>): Post | undefined {
    const index = this.posts.findIndex((p) => p.id === id);
    if (index === -1) return undefined;
    this.posts[index] = { ...this.posts[index], ...data };
    return this.posts[index];
  }

  remove(id: number): boolean {
    const lengthBefore = this.posts.length;
    this.posts = this.posts.filter((p) => p.id !== id);
    return this.posts.length < lengthBefore;
  }
}
