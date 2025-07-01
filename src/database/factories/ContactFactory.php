<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;
use App\Models\User;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        $nameParts = explode(' ', $user->name . ' ');
        $lastName = $nameParts[0] ?? '';
        $firstName = $nameParts[1] ?? '';

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $user->email,
            'tel' => $this->faker->phoneNumber(),
            'address' => $this->faker->randomElement([
                '東京都', '大阪府', '福岡県', '北海道', '愛知県', '京都府'
            ]) . $this->faker->city() . $this->faker->streetAddress(),
            'building' => $this->faker->secondaryAddress(),
            'detail' => $this->faker->realText(30),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ];
    }
}
