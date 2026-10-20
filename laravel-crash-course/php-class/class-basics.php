<?php
declare(strict_types=1);

class Post
{
    public function __construct(public string $title, public int $views = 0)
    {
    }

    public function addView(): void
    {
        $this->views++;
    }

    public function summary(): string
    {
        return "{$this->title} ({$this->views} views)";
    }
}

$a = new Post('Hello');
$b = new Post('PHP', 10);

$a->addView();
$a->addView();
$b->addView();

echo $a->summary(), "\n";
echo $b->summary(), "\n";
echo $a->title, "\n";