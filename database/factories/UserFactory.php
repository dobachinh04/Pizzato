<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition(): array
    {
        // Danh sách email cần tránh
        $restrictedEmails = ['admin@gmail.com', 'user@gmail.com'];

        // Tạo email ngẫu nhiên và kiểm tra trùng lặp
        $email = $this->generateUniqueEmail($restrictedEmails);

        return [
            'name' => fake('vi_VN')->name(), // Tên tiếng Việt
            'email' => $email, // Email ngẫu nhiên không trùng
            'email_verified_at' => now(),
            'password' => bcrypt('123456'), // Mật khẩu mặc định
            'remember_token' => Str::random(10),
            'role_id' => fake()->numberBetween(1, 3), // Role ID ngẫu nhiên từ 1 đến 3
        ];
    }

    /**
     * Generate a unique email address avoiding restricted ones.
     */
    private function generateUniqueEmail(array $restrictedEmails): string
    {
        do {
            $email = fake()->unique()->safeEmail();
        } while (in_array($email, $restrictedEmails));

        return $email;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
