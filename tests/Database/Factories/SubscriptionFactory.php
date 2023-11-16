<?php

namespace Laravel\Cashier\Tests\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Tests\Fixtures\User;

class SubscriptionFactory extends Factory
{
    /**
     * Get the name of the model that is generated by the factory.
     *
     * @return string
     */
    public function modelName()
    {
        return Cashier::$subscriptionModel;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'dummy name',
            'plan' => 'monthly-10-1',
            'owner_id' => 1,
            'owner_type' => User::class,
            'cycle_started_at' => now(),
            'cycle_ends_at' => function (array $subscription) {
                return Carbon::parse($subscription['cycle_started_at'])->addMonth();
            },
            'tax_percentage' => 0,
        ];
    }
}