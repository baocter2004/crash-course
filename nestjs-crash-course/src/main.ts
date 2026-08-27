import { NestFactory } from '@nestjs/core';
import { AppModule } from './app.module';

async function bootstrap() {
  const app = await NestFactory.create(AppModule);

  const port = process.env.PORT ?? 30100;

  await app.listen(port);

  console.log(`This app url: http://localhost:${port}`);
}

bootstrap();
