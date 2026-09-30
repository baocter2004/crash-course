import { NestFactory } from '@nestjs/core';
import { DataSource } from 'typeorm';
import { AppModule } from './app.module';

import { Post } from './posts/entities/post.entity';
import { Comment } from './comments/entities/comment.entity';
import { Category } from './categories/entities/category.entity';
import { Product } from './products/entities/product.entity';

const POSTS = 20;
const COMMENTS_PER_POST = 10;

const CATEGORIES = [
  {
    name: 'Điện thoại',
    description: 'Các sản phẩm điện thoại thông minh',
  },
  {
    name: 'Laptop',
    description: 'Các sản phẩm máy tính xách tay',
  },
  {
    name: 'Tai nghe',
    description: 'Các sản phẩm tai nghe và thiết bị âm thanh',
  },
  {
    name: 'Bàn phím',
    description: 'Các sản phẩm bàn phím máy tính',
  },
  {
    name: 'Chuột',
    description: 'Các sản phẩm chuột máy tính',
  },
];

const PRODUCTS = [
  {
    name: 'iPhone 17',
    price: 25990000,
    description: 'Điện thoại Apple iPhone 17',
    categoryIndex: 0,
  },
  {
    name: 'Samsung Galaxy S26',
    price: 22990000,
    description: 'Điện thoại Samsung Galaxy S26',
    categoryIndex: 0,
  },
  {
    name: 'Xiaomi 16',
    price: 15990000,
    description: 'Điện thoại Xiaomi 16',
    categoryIndex: 0,
  },

  {
    name: 'MacBook Air M4',
    price: 28990000,
    description: 'Laptop Apple MacBook Air M4',
    categoryIndex: 1,
  },
  {
    name: 'Dell XPS 14',
    price: 35990000,
    description: 'Laptop Dell XPS 14',
    categoryIndex: 1,
  },
  {
    name: 'ASUS Zenbook 14',
    price: 24990000,
    description: 'Laptop ASUS Zenbook 14',
    categoryIndex: 1,
  },

  {
    name: 'AirPods Pro',
    price: 6490000,
    description: 'Tai nghe Apple AirPods Pro',
    categoryIndex: 2,
  },
  {
    name: 'Sony WH-1000XM6',
    price: 9990000,
    description: 'Tai nghe chống ồn Sony',
    categoryIndex: 2,
  },
  {
    name: 'Galaxy Buds',
    price: 3990000,
    description: 'Tai nghe Samsung Galaxy Buds',
    categoryIndex: 2,
  },

  {
    name: 'Keychron K2',
    price: 2190000,
    description: 'Bàn phím cơ Keychron K2',
    categoryIndex: 3,
  },
  {
    name: 'Logitech MX Keys',
    price: 2490000,
    description: 'Bàn phím Logitech MX Keys',
    categoryIndex: 3,
  },
  {
    name: 'Akko 5075B',
    price: 1890000,
    description: 'Bàn phím cơ Akko 5075B',
    categoryIndex: 3,
  },

  {
    name: 'Logitech MX Master 3S',
    price: 2490000,
    description: 'Chuột Logitech MX Master 3S',
    categoryIndex: 4,
  },
  {
    name: 'Razer DeathAdder V3',
    price: 1990000,
    description: 'Chuột gaming Razer DeathAdder V3',
    categoryIndex: 4,
  },
  {
    name: 'Logitech G Pro X Superlight',
    price: 3290000,
    description: 'Chuột gaming Logitech G Pro X Superlight',
    categoryIndex: 4,
  },
];

async function seed() {
  const app = await NestFactory.createApplicationContext(AppModule, {
    logger: ['error', 'warn'],
  });

  const dataSource = app.get(DataSource);

  try {
    await dataSource.transaction(async (manager) => {
      const categories = await manager.save(
        Category,
        CATEGORIES.map((category) =>
          manager.create(Category, {
            name: category.name,
            description: category.description,
          }),
        ),
      );

      const products = PRODUCTS.map((product) =>
        manager.create(Product, {
          name: product.name,
          price: product.price,
          description: product.description,
          category: categories[product.categoryIndex],
        }),
      );

      await manager.save(Product, products);

      for (let i = 1; i <= POSTS; i++) {
        const post = await manager.save(Post, {
          title: `Post ${i}`,
          body: `Nội dung bài viết số ${i}`,
        });

        const comments = Array.from({ length: COMMENTS_PER_POST }, (_, j) =>
          manager.create(Comment, {
            content: `Comment ${j + 1} của post ${i}`,
            post,
          }),
        );

        await manager.save(Comment, comments);
      }
    });

    const categoryCount = await dataSource.getRepository(Category).count();

    const productCount = await dataSource.getRepository(Product).count();

    const postCount = await dataSource.getRepository(Post).count();

    const commentCount = await dataSource.getRepository(Comment).count();

    console.log(`
Seed xong:
- ${categoryCount} categories
- ${productCount} products
- ${postCount} posts
- ${commentCount} comments
    `);
  } catch (err) {
    console.error('Seed thất bại:', err);
    process.exitCode = 1;
  } finally {
    await app.close();
  }
}

seed();
