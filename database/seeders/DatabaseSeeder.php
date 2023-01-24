<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Card;
use App\Models\Desk;
use App\Models\DeskList;
use App\Models\Task;
use App\Models\User;
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
        User::factory(10)->create();

        $desks = Desk::factory(3)->create();

        $deskLists = DeskList::factory(10)->make()->each(function ($deskList) use ($desks) {
            $deskList->desk_id = $desks->random()->id;
            $deskList->save();
        });

        $cards = Card::factory(20)->make()->each(function ($card) use ($deskLists) {
            $card->desk_list_id = $deskLists->random()->id;
            $card->save();
        });

        Task::factory(50)->make()->each(function ($task) use ($cards) {
            $task->card_id = $cards->random()->id;
            $task->save();
        });
    }
}
