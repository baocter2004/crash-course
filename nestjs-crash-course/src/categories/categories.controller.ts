import { Controller, Get, Query } from '@nestjs/common';
import { CategoriesService } from './categories.service';
import { PaginationQueryDto } from 'src/common/dto/pagination-query.dto';

@Controller('categories')
export class CategoriesController {
  constructor(private readonly categoriesService: CategoriesService) {}

  // [GET] /categories
  @Get()
  findAll(@Query() query: PaginationQueryDto) {
    return this.categoriesService.findAll(query);
  }
}
