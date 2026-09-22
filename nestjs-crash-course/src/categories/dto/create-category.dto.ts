import { IsNotEmpty, IsString, Max } from 'class-validator';

export class CreateCategoryDto {
  @IsString()
  @Max(50)
  @IsNotEmpty()
  name: string;

  @IsString()
  @Max(255)
  description: string;
}
