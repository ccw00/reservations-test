<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()
            ->withName('George Sburlan')
            ->withEmail('laurentiu.sburlan@gmail.com')
            ->create();

        User::factory(10)->create();

        $event = Event::factory()
            ->withTitle('Event Test By Me')
            ->withDescription('Another description for this specific event.')
            ->withDeadline(today())
            ->create();

        Event::factory()
            ->withTitle('Me Event Test')
            ->withDescription('Other description for this specific event.')
            ->withDeadline(today())
            ->create();

        Event::factory(15)->create();

        Reservation::factory()
            ->withEvent($event)
            ->withUser($user)
            ->create();

        Reservation::factory(30)->create();
    }
}
