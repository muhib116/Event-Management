<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MEvents>
 */
class MEventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $locations = [
        'location 1',
        'location 2',
        'location 3'
    ];
    
    protected $eventsCategory = [
        "Arts Culture",
        "Business",
        "Concerts",
        "Career",
        'Charity & Aid',
        "Children & Youth",
        "Community",
        "Fashion & Design",
        "Food & Drink",
        "Government",
        "Investments",
        "Media & Film",
        "Music & Performances",
        "Schools & Education",
        "Spirituality & Religion",
        "Sports & Fitness",
        "Startups & Small Business",
        "Technology & Science",
    ];
    private $timeZeone = [
        '-12',
        '-11',
        '-10',
        '-9',
        '-8',
        '-8',
        '-7',
        '-7',
        '-7',
        '-6',
        '-6',
        '-6',
        '-6',
        '-5',
        '-5',
        '-5',
        '-4',
        '-4',
        '-4',
        '-4',
        '-3.5',
        '-3',
        '-3',
        '-3',
        '-3',
        '-2',
        '-1',
        '-1',
        '0',
        '0',
        '1',
        '1',
        '1',
        '1',
        '1',
        '2',
        '2',
        '2',
        '2',
        '2',
        '2',
        '2',
        '2',
        '2',
        '3',
        '3',
        '3',
        '3',
        '3.5',
        '4',
        '4',
        '4',
        '4.5',
        '5',
        '5',
        '5.5',
        '5.5',
        '6',
        '6',
        '6.5',
        '7',
        '7',
        '8',
        '8',
        '8',
        '8',
        '8',
        '9',
        '9',
        '9',
        '9.5',
        '9.5',
        '10',
        '10',
        '10',
        '10',
        '10',
        '11',
        '12',
        '12',
        '13',
    ];

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
        $start_date = Carbon::now()->addDay(rand(1,20));
        $end_date = $start_date->addDay(rand(0, 20));
        $category = $this->eventsCategory[rand(0, count($this->eventsCategory)-1)];
        $name = fake()->unique()->words(5, true);
        return [
            'name' => $name,
            'slug' => str()->slug($name),
            'description' => fake()->text(),
            'location' => $this->locations[rand(0, count($this->locations)-1)],
            'location_tips' => fake()->text(50),
            'custom_url' => rand(0, 1) ? str()->slug(fake()->text(20)) : null,
            'video_link' => rand(0, 1) ? 'https://youtu.be/I2A3Se0G75U' : null,
            'eventCategory' => $category,
            'eventType' => $this->eventTypes[rand(0, count($this->eventTypes)-1)],
            'time_zone' => $this->timeZeone[rand(0, count($this->timeZeone)-1)],
            'start_date' => $start_date->format('Y-m-d'),
            'start_time' => $start_date->addMinute(rand(1, 24))->format('H:s:i'),
            'end_date' => $end_date->format('Y-m-d'),
            'end_time' => $end_date->addMinute(rand(1, 24))->format('H:s:i'),
            'event_date_type' => $this->dateType[rand(0, count($this->dateType)-1)],
            'image' => 'https://picsum.photos/1386/400',
            'map_link' => rand(0,1) ? 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3627.3283267596366!2d90.45460417226253!3d24.612366333998356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1670791344528!5m2!1sen!2sbd' : null,
            'website' => 'https://picsum.photos',
            'instagram' => 'https://www.instagram.com',
            'twitter' => 'https://www.twitter.com',
            'facebook' => 'https://www.facebook.com',
            'status' => rand(0, 1),
        ];
    }
}
