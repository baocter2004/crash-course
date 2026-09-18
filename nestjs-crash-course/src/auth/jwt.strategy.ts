import { ConfigService } from '@nestjs/config';
import { Injectable, UnauthorizedException } from '@nestjs/common';
import { PassportStrategy } from '@nestjs/passport';
import { ExtractJwt, Strategy } from 'passport-jwt';
import { UsersService } from 'src/users/users.service';

type JwtPayload = { sub: number; email: string };

@Injectable()
export class JwtStrategy extends PassportStrategy(Strategy) {
  constructor(
    config: ConfigService,
    private readonly usersService: UsersService,
  ) {
    super({
      jwtFromRequest: ExtractJwt.fromAuthHeaderAsBearerToken(),
      // đọc "Authorization: Bearer <token>"
      ignoreExpiration: false,
      // token hết hạn -> 401
      secretOrKey: config.getOrThrow<string>('JWT_SECRET'),
      // cùng secret lúc ký
    });
  }

  // Passport CHỈ gọi validate() sau khi chữ ký + hạn đã hợp lệ.
  // Return gì → Nest gán vào request.user. Throw → 401.
  async validate(payload: JwtPayload) {
    const user = await this.usersService.findById(payload.sub);
    if (!user) throw new UnauthorizedException(); // user đã bị xoá sau khi cấp token
    return { userId: user.id, email: user.email }; // KHÔNG trả password hash
  }
}
