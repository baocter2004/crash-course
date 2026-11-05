<?php
declare(strict_types=1);

// Nullsafe ?->

class Address {
    public function __construct(public string $city){}
}

class Profile {
    public function __construct(public ?Address $address = null){}
}

class User {
    public function __construct(public ?Profile $profile = null){}
}

$user1 = new User(new Profile(new Address('Hà Nội')));
$user2 = new User(new Profile());
$user3 = new User(new Profile());

echo $user1->profile?->address?->city ?? 'Chưa rõ', "\n"; // Hà Nội
echo $user2->profile?->address?->city ?? 'Chưa rõ', "\n"; // Chưa rõ
echo $user3->profile?->address?->city ?? 'Chưa rõ', "\n"; // Chưa rõ