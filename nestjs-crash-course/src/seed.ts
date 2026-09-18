import { NestFactory } from '@nestjs/core';
import { DataSource } from 'typeorm';
import { AppModule } from './app.module';
import { Post } from './posts/enities/post.entity';
import { Comment } from './comments/enities/comment.enity';

const POSTS = 20;
const COMMENTS_PER_POST = 10;

async function seed() {
  // createApplicationContext: khởi tạo DI container + DB, KHÔNG mở HTTP server
  const app = await NestFactory.createApplicationContext(AppModule, {
    logger: ['error', 'warn'],
  });
  const dataSource = app.get(DataSource);

  // Toàn bộ seed trong 1 transaction: lỗi giữa chừng thì không có dòng nào được ghi
  await dataSource.transaction(async (manager) => {
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

  const posts = await dataSource.getRepository(Post).count();
  const comments = await dataSource.getRepository(Comment).count();
  console.log(`Seed xong: ${posts} post, ${comments} comment trong DB`);

  await app.close();
}

seed().catch((err) => {
  console.error('Seed thất bại:', err);
  process.exit(1);
});
