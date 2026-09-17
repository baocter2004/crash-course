import { Comment } from 'src/comments/enities/comment.enity';
import { Column, Entity, OneToMany, PrimaryGeneratedColumn } from 'typeorm';

@Entity()
export class Post {
  @PrimaryGeneratedColumn()
  id: number;

  @Column()
  title: string;

  @Column()
  body: string;

  @OneToMany(() => Comment, (comment) => comment.post)
  comments: Comment[];
}
