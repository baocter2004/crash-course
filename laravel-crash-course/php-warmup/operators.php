<?php

declare(strict_types=1);

// $settings = ['theme' => 'dark', 'perPage' => 0, 'lang' => null];


// echo $settings['theme'] ?? 'light';
// echo "\n";
// echo $settings['perPage'] ?? 15;
// echo "\n";
// echo $settings['perPage'] ?: 15; // falsy
// echo "\n";
// echo $settings['lang'] ?? 'vi';
// echo "\n";
// echo $setting['timezone'] ?? 'UTC';
// echo "\n";

// class Address
// {
//     public function __construct(public string $city) {}
// }

// class Profile
// {
//     public function __construct(public ?Address $address = null) {}
// }

// class User
// {
//     public function __construct(public ?Profile $profile = null) {}
// }

// $user1 = new User(new Profile(new Address('Hà Nội')));
// $user2 = new User(new Profile());
// $user3 = new User();

// echo $user1->profile?->address?->city ?? 'Chưa rõ';
// echo "\n";
// echo $user2->profile?->address?->city ?? 'Chưa rõ';
// echo "\n";
// echo $user3->profile?->address?->city ?? 'Chưa rõ';
// echo "\n";

// function httpLabel(int $code): string
// {
//     return match ($code) {
//         200, 201 => 'Thành Công',
//         301, 302 => 'Chuyển Hướng',
//         404 => 'Không Tồn Tại',
//         500 => 'Lỗi Server',
//     };
// }

// // test
// try {
//     httpLabel(418);
// } catch (\UnhandledMatchError $e) {
//     echo $e->getMessage() . "\n";
// }

// function shippingFee(int $total): int
// {
//     return match (true) {
//         $total >= 500000 => 0,
//         $total >= 200000 => 15000,
//         default => 30000,
//     };
// }

// echo shippingFee(100000) . "\n";
// echo shippingFee(200000) . "\n";
// echo shippingFee(450000) . "\n";
// echo shippingFee(500000) . "\n";

$posts = [
    ['title' => 'Vue', 'views' => 50],
    ['title' => 'Laravel', 'views' => 100],
    ['title' => 'Docker', 'views' => 100],
    ['title' => 'PHP', 'views' => 50],
    ['title' => 'Redis', 'views' => 100],
];

usort($posts, fn($a, $b) => ($b['views'] <=> $a['views']) ?: ($a['title'] <=> $b['title']));
foreach ($posts as $post) {
    echo $post['title'] . ' - ' . $post['views'] . "\n";
}
