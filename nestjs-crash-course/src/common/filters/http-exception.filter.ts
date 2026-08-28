import {
  ArgumentsHost,
  Catch,
  ExceptionFilter,
  HttpException,
} from '@nestjs/common';
import { Request, Response } from 'express';

interface ExceptionPayload {
  message?: string | string[];
}

@Catch(HttpException)
export class HttpExceptionFilter implements ExceptionFilter {
  catch(exception: HttpException, host: ArgumentsHost) {
    const ctx = host.switchToHttp();
    const response = ctx.getResponse<Response>();
    const request = ctx.getRequest<Request>();
    const status = exception.getStatus();

    // getResponse() trả về string (khi throw new NotFoundException('msg'))
    // HOẶC object { message, error, statusCode } (khi Nest tự tạo payload).
    // Phải bóc ra, nếu không client sẽ phải đọc body.message.message.
    const payload = exception.getResponse();
    const message =
      typeof payload === 'string'
        ? payload
        : ((payload as ExceptionPayload).message ?? exception.message);

    // Cùng khoá "success" với TransformInterceptor để client chỉ cần 1 nhánh xử lý.
    response.status(status).json({
      success: false,
      statusCode: status,
      path: request.url,
      timestamp: new Date().toISOString(),
      message,
    });
  }
}
