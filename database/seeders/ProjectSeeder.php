<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use App\Models\Type;

use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $type_ids = Type::all()->pluck('id');
        $type_ids[] = null;

        for ($i = 0; $i < 100; $i++) {
            $project = new Project();

            $project->type_id = $faker->randomElement($type_ids);                                                              
            $project->title = $faker->catchPhrase();
            $project->description = $faker->paragraph(2, true);
            $project->link = $faker->url();
            $project->date= $faker->dateTime();
            // $project->coding_lang= $faker;
           
            $project->save();
        }

    }
}
