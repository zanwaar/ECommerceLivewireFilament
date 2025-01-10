<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();

        foreach ($users as $user) {
            $order = Order::create([
                'user_id' => $user->id,
                'grand_total' => fake()->randomFloat(2, 100, 1000),
                'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'bank_transfer']),
                'payment_status' => fake()->randomElement(['pending', 'paid', 'failed']),
                'status' => fake()->randomElement(['new', 'processing', 'shipped', 'delivered', 'cancelled']),
                'currency' => 'USD',
                'shipping_amont' => fake()->randomFloat(2, 10, 50),
                'shipping_method' => fake()->randomElement(['express', 'standard', 'economy']),
                'note' => fake()->sentence()
            ]);

            // Create address for the order
            $order->address()->create([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'phone' => fake()->phoneNumber(),
                'street_address' => fake()->streetAddress(),
                'city' => fake()->city(),
                'state' => fake()->state(),
                'zip_code' => fake()->postcode(),
                'grand_total' => $order->grand_total
            ]);

            // Create 1-5 order items for each order
            $numItems = fake()->numberBetween(1, 5);
            for ($i = 0; $i < $numItems; $i++) {
                $unitAmount = fake()->randomFloat(2, 10, 200);
                $quantity = fake()->numberBetween(1, 5);
                $order->items()->create([
                    'product_id' => fake()->numberBetween(1, 4), // Assuming you have products with IDs 1-10
                    'quantity' => $quantity,
                    'unit_amount' => $unitAmount,
                    'total_amount' => $unitAmount * $quantity,
                ]);
            }
        }
    }
}
