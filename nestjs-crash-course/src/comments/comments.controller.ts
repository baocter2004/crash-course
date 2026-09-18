import {
  Body,
  Controller,
  Get,
  Param,
  ParseIntPipe,
  Post as HttpPost,
  UseGuards,
} from '@nestjs/common';
import { CommentsService } from './comments.service';
import { CreateCommentDto } from './dto/create-comment.dto';
import { JwtAuthGuard } from 'src/auth/jwt-auth.guard';

@Controller('posts/:postId/comments')
export class CommentsController {
  constructor(private readonly commentsService: CommentsService) {}

  @Get()
  findAll(@Param('postId', ParseIntPipe) postId: number) {
    return this.commentsService.findAllByPost(postId);
  }

  @UseGuards(JwtAuthGuard)
  @HttpPost()
  create(
    @Param('postId', ParseIntPipe) postId: number,
    @Body() dto: CreateCommentDto,
  ) {
    return this.commentsService.create(postId, dto);
  }
}
