<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;

use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $_technologies = ["html", "css","bootstrap", "scss", 'js', "vue", "php", "mysql", "larabel", "markdown"];

        foreach($_technologies as $_technology) {
            $technology = new Technology();

            $technology->label = $_technology;
            $technology->color = $faker->hexColor();
            $technology->save();    
        }
    }
}
