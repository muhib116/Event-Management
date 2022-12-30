<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Images;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
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
    public function run()
    {
        
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'type' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        \App\Models\User::factory()->create([
            'first_name' => 'Client',
            'last_name' => 'User',
            'type' => 'clients',
            'email' => 'client@gmail.com',
        ]);
        \App\Models\User::factory()->create([
            'first_name' => 'Organizer',
            'last_name' => 'User',
            'type' => 'organizer',
            'email' => 'org@gmail.com',
        ]);
        \App\Models\SiteSetting::insert([
            ['name' => 'commission', 'value' => ''],
            ['name' => 'currency','value' => ''],
            ['name' => 'home_banner_image','value' => ''],
            ['name' => 'logo_image','value' => ''],
            ['name' => 'footer_logo_image','value' => ''],
            ['name' => 'home_banner_text','value' => ''],

            ['name' => 'facebook_link','value' => ''],
            ['name' => 'twitter_link','value' => ''],
            ['name' => 'tiktok_link','value' => ''],
            ['name' => 'instagram_link','value' => ''],
            ['name' => 'youtube_link','value' => ''],
            ['name' => 'telegram_link','value' => ''],
            
        ]);
        // \App\Models\EventList::factory(100)->create();

        // $events = \App\Models\EventList::all();
        // foreach ($events as $event) {
        //     $ticketTypes = $this->ticketTypes[rand(0, count($this->ticketTypes)-1)];
        //     $dateType = $this->dateType[rand(0, count($this->dateType)-1)];

        //     Images::create([
        //         'foreign_id' => $event->id,
        //         'path' => 'images/banner-0f628891312da22a191d987b4bb81a07-Anker-Soundcore-Life-Note-3i_638adb1216ec7.png',
        //         'type' => 'banner',
        //     ]);

        //     $event->eventTickets()->create([
        //         "user_id"    => \App\Models\User::all()->random(1)->first()->id,
        //         // 'event_id'      => $request->event_id,
        //         'ticketType'    => $ticketTypes,
        //         'ticket_name'   => fake()->name(),
        //         'ticket_stock'  => rand(1, 200),
        //         'stock_limit'   => rand(1, 200),
        //         'price'         => $ticketTypes == 'Paid' ? rand(10, 100) : 0,
        //         'purchase_limit' => rand(1, 10),
        //         'questions'      => null,
        //         'perks'          => null,
        //         'ticket_description'    => fake()->realText(300),
        //         'isTransferFeesToGuest' => rand(0, 1),
        //         // 'settings' => $request->settings,
        //     ]);
        // }

        // \App\Models\Ticket::factory(500)->create();
        // $this->call(TimeZoneSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(CategorySeeder::class);
    }
}
