<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Card::create([
            'title' => 'My first card',
            'description' => 'Card on column 1',
            'column_id' => 1
        ]);

        Card::create([
            'title' => 'My second card',
            'description' => 'Card on column 2',
            'column_id' => 2
        ]);
    }
}
