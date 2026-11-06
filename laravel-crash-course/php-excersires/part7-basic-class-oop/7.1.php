<?php
declare(strict_types=1);

// Class

class Post {
    public function __construct(
        public string $title,
        public int $views = 0,
    ){}

    public function addView(): void {
        $this->views++;
    }

    // method summary(): string trả về chuỗi dạng Hello (2 views) .
    public function summary(): string {
        return $this->title . "( $this->views views )";
    }
}

$a = new Post('Hello');
$b = new Post('PHP', 10);

$a->addView();
$a->addView();
$b->addView();

echo $a->summary() . PHP_EOL;
echo $b->summary() . PHP_EOL;
echo $a->title . PHP_EOL;