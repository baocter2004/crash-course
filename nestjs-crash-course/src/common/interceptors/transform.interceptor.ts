import {
  CallHandler,
  ExecutionContext,
  Injectable,
  NestInterceptor,
} from '@nestjs/common';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { isPaginated, PaginationMeta } from '../pagination';

export interface ApiResponse<T> {
  success: true;
  data: T;
}

export interface PaginatedApiResponse<T> {
  success: true;
  data: T[];
  meta: PaginationMeta;
}

@Injectable()
export class TransformInterceptor<T> implements NestInterceptor<
  T,
  ApiResponse<T> | PaginatedApiResponse<unknown>
> {
  intercept(
    context: ExecutionContext,
    next: CallHandler<T>,
  ): Observable<ApiResponse<T> | PaginatedApiResponse<unknown>> {
    return next.handle().pipe(
      map((payload) =>
        isPaginated(payload)
          ? // Service đã trả { data, meta } → trải phẳng, KHÔNG bọc thêm lớp data
            { success: true as const, data: payload.data, meta: payload.meta }
          : // Mọi response khác → bọc như cũ
            { success: true as const, data: payload },
      ),
    );
  }
}
