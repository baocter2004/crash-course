import {
  Body,
  Controller,
  Delete,
  Get,
  Param,
  Post,
  Put,
} from '@nestjs/common';
import { PostsService } from './posts.service';
import { CreatePostDto } from './dto/create-post.dto';
import { UpdatePostDto } from './dto/update-post.dto';

interface Post {
  id: number;
  title: string;
  body: string;
}

@Controller('posts')
export class PostsController {
  constructor(private readonly postsService: PostsService) {}
  // [GET] /posts
  @Get()
  findAll(): Post[] {
    return this.postsService.findAll();
  }

  // [GET] /posts/:id
  @Get(':id')
  findOne(@Param('id') id: string): Post | { message: string } {
    const post = this.postsService.findOne(Number(id));
    if (!post) {
      return { message: `Post with id ${id} not found` };
    }
    return post;
  }

  // [POST] /posts
  @Post()
  create(@Body() createPostDto: CreatePostDto): Post {
    return this.postsService.create(createPostDto);
  }

  // [PUT] /posts/:id
  @Put(':id')
  update(
    @Param('id') id: string,
    @Body() updatePostDto: UpdatePostDto,
  ): Post | { message: string } {
    const updated = this.postsService.update(Number(id), updatePostDto);
    if (!updated) {
      return { message: `Post with id ${id} not found` };
    }
    return updated;
  }

  // [DELETE] /posts/:id
  @Delete(':id')
  remove(@Param('id') id: string): { message: string } {
    const deleted = this.postsService.remove(Number(id));
    if (!deleted) {
      return { message: `Post with id ${id} not found` };
    }
    return { message: `Post with id ${id} deleted` };
  }
}
