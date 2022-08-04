<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create admin (super) user.
        \App\Models\User::factory(1)->create();

        // Create some categories for tickets.
        \App\Models\TicketCategory::factory(5)->create();

        // Create common ticket statuses.
        \App\Models\TicketStatus::factory()->createMany([
            [
                'slug' => 'opened',
                'title' => 'Opened',
            ], [
                'slug' => 'closed',
                'title' => 'Closed',
            ]
        ]);
    }
}
