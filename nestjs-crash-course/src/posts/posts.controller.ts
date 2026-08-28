import {
  Body,
  Controller,
  Delete,
  Get,
  Param,
  Post,
  Put,
  ParseIntPipe,
  UseGuards,
} from '@nestjs/common';
import { PostsService } from './posts.service';
import { CreatePostDto } from './dto/create-post.dto';
import { UpdatePostDto } from './dto/update-post.dto';
import { AuthGuard } from 'src/common/guards/auth.guard';

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
  findOne(@Param('id', ParseIntPipe) id: number): Post {
    return this.postsService.findOne(id);
  }

  // [POST] /posts
  @UseGuards(AuthGuard)
  @Post()
  create(@Body() createPostDto: CreatePostDto): Post {
    return this.postsService.create(createPostDto);
  }

  // [PUT] /posts/:id
  @UseGuards(AuthGuard)
  @Put(':id')
  update(
    @Param('id', ParseIntPipe) id: number,
    @Body() updatePostDto: UpdatePostDto,
  ): Post {
    return this.postsService.update(id, updatePostDto);
  }

  // [DELETE] /posts/:id
  @UseGuards(AuthGuard)
  @Delete(':id')
  remove(@Param('id', ParseIntPipe) id: number) {
    this.postsService.remove(id);
    return { message: `Post with id ${id} deleted` };
  }
}
