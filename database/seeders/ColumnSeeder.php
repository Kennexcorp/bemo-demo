<?php

namespace Database\Seeders;

use App\Models\Column;
use Illuminate\Database\Seeder;

class ColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $column = Column::create([
            'title' => 'My First Column'
        ]);

        $column->state()->create([]);

        $column1 = Column::create([
            'title' => 'My Second Column'
        ]);
        
        $column1->state()->create([]);
    }
}
