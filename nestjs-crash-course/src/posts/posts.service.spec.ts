import { Test } from '@nestjs/testing';
import { getRepositoryToken } from '@nestjs/typeorm';
import { NotFoundException } from '@nestjs/common';
import { PostsService } from './posts.service';
import { Post } from './enities/post.entity';

describe('PostsService', () => {
  let service: PostsService;
  // Mock: object có đúng các method service gọi, mỗi method là jest.fn() để ta điều khiển kết quả
  const repo = {
    find: jest.fn(),
    findOne: jest.fn(),
    findOneBy: jest.fn(),
    create: jest.fn(),
    save: jest.fn(),
    remove: jest.fn(),
  };

  beforeEach(async () => {
    jest.clearAllMocks();
    const module = await Test.createTestingModule({
      providers: [
        PostsService,
        { provide: getRepositoryToken(Post), useValue: repo }, // thay Repository thật bằng mock
      ],
    }).compile();

    service = module.get(PostsService);
  });

  it('findOne trả post khi tồn tại', async () => {
    repo.findOne.mockResolvedValue({ id: 1, title: 'A', body: 'B' });

    await expect(service.findOne(1)).resolves.toEqual({
      id: 1,
      title: 'A',
      body: 'B',
    });
    expect(repo.findOne).toHaveBeenCalledWith(
      expect.objectContaining({ where: { id: 1 } }),
    );
  });

  it('findOne ném NotFoundException khi không có', async () => {
    repo.findOne.mockResolvedValue(null);

    await expect(service.findOne(999)).rejects.toThrow(NotFoundException);
  });

  it('create gọi create rồi save', async () => {
    const dto = { title: 'New', body: 'Body' };
    repo.create.mockReturnValue(dto); // create() ĐỒNG BỘ → mockReturnValue
    repo.save.mockResolvedValue({ id: 7, ...dto }); // save() async → mockResolvedValue

    await expect(service.create(dto)).resolves.toEqual({ id: 7, ...dto });
    expect(repo.save).toHaveBeenCalledWith(dto);
  });
});
