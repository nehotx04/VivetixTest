<?php

namespace Database\Factories;

use App\Models\TicketOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketOrderFactory extends Factory
{
    // Define the model and its default state
    protected $model = TicketOrder::class;

    public function definition()
    {
        // Define the model's default state
        return [
            'pay_info' => 'Default Pay Info',
            'pay_info_path' => 'Default Pay Info Path',
            'buyer_name' => $this->faker->firstName,
            'buyer_lastname' => $this->faker->lastName,
            'buyer_dni' => $this->faker->randomNumber(8),
            'ticket_ammount' => $this->faker->numberBetween(1, 10),
            'event_id' => function () {
                return \App\Models\Event::factory()->create()->id;
            },
        ];
    }
}