<?php
declare(strict_types=1);

class BankAccount
{
    public function __construct(private int $balance = 0)
    {
    }

    public function deposit(int $amount = 0): void
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException("Số tiền phải lớn hơn 0");
        }
        $this->balance += $amount;
    }

    public function withdraw(int $amount): void
    {
        if ($amount > $this->balance) {
            throw new RuntimeException("Số dư không đủ");
        } else if ($amount <= 0) {
            throw new InvalidArgumentException("Số tiền không hợp lệ.");
        }
        $this->balance -= $amount;
    }

    public function balance(): int
    {
        return $this->balance;
    }
}

$acc = new BankAccount();
$acc->deposit(1000);
$acc->withdraw(300);
echo $acc->balance(), "\n";

try {
    $acc->withdraw(5000);
} catch (InvalidArgumentException $e) {
    echo 'Đầu vào sai: ', $e->getMessage(), "\n";
} catch (RuntimeException $e) {
    echo 'Lỗi nghiệp vụ: ', $e->getMessage(), "\n";
} finally {
    echo 'Xong', "\n";
}

try {
    $acc->deposit(-5);
} catch (InvalidArgumentException $e) {
    echo 'Đầu vào sai: ', $e->getMessage(), "\n";
} catch (RuntimeException $e) {
    echo 'Lỗi nghiệp vụ: ', $e->getMessage(), "\n";
}
echo $acc->balance(), "\n";