<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator;
use App\Models\Type;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $_tags = [
            "Front-end",
            "Back-end",
            "Full-stack",
        ];

        foreach ($_tags as $_tag) {
            $type = new Type();

            $type->tag = $_tag;
            $type->color = $faker->hexColor();
            $type->save();                                      
        }   
    }
}
