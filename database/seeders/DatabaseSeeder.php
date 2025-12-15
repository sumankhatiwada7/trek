<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        destination::query()->truncate();

        $rows = [
            [
                'destination_name' => 'Everest Region',
                'region' => 'Solukhumbu',
                'description' => 'Home to Everest with Sherpa culture, high passes, and iconic viewpoints.',
                'elevation' => '2,800m – 5,545m',
                'best_season' => 'Mar–May, Sep–Nov',
                'treks_available' => 'EBC, Gokyo Lakes, Three Passes',
                'tagline' => 'Where legends touch the sky',
                'path' => null,
            ],
            [
                'destination_name' => 'Annapurna Region',
                'region' => 'Gandaki',
                'description' => 'Diverse landscapes from subtropical valleys to alpine trails around Annapurna.',
                'elevation' => '800m – 5,416m',
                'best_season' => 'Mar–May, Oct–Dec',
                'treks_available' => 'ABC, Poon Hill, Annapurna Circuit',
                'tagline' => 'Circles of mountains and culture',
                'path' => null,
            ],
            [
                'destination_name' => 'Upper Mustang',
                'region' => 'Mustang',
                'description' => 'Rain-shadow desert with Tibetan heritage, caves, and walled city Lo Manthang.',
                'elevation' => '2,800m – 4,200m',
                'best_season' => 'May–Oct',
                'treks_available' => 'Lo Manthang, Chhoser Caves',
                'tagline' => 'The last forbidden kingdom',
                'path' => null,
            ],
        ];

        foreach ($rows as $row) {
            destination::create($row);
        }
    }
}
