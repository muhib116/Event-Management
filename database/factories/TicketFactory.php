<?php

namespace Database\Factories;

use App\Models\MEvents;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     
    private $eventTypes = [
        'Single Event',
        'Recurring Event',
        'One-on-One',
    ];

    private $ticketTypes = [
        'Free',
        'Paid',
        'Invite only',
    ];
    private $dateType = [
        'Single Event',
        'Recurring Event',
        'One-on-One',
    ];
    public function definition()
    {
        $type = $this->ticketTypes[rand(0, count($this->ticketTypes)-1)];
        $date_type = $this->dateType[rand(0, count($this->dateType)-1)];
        return [
            'm_events_id' => MEvents::inRandomOrder()->first(),
            'ticket_name' => fake()->name(),
            'ticket_description' => fake()->text(),
            'ticket_type' => $type,
            'ticket_stock' => rand(100, 300),
            'stock_limit' => rand(2, 5),
            'price' => $type == 'Paid' ? rand(200, 500) : 0,
            'perks' => ['perks 1', 'perks 2'],
            'isTransferFeesToGuest' => rand(0, 1),
            'questions' => ['alskd', 'asdf'],
            'settings' => null,
        ];
    }
}
