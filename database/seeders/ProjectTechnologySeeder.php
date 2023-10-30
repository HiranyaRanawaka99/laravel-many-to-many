<?php

namespace Database\Seeders;

use Faker\Generator;

use App\Models\Technology;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $projects = Project::all();                   
        $technologies = Technology::all()->pluck('id')->toArray();
      
        foreach($projects as $project) {
          $project
            ->technologies()
            ->attach($faker->randomElements($technologies, random_int(0, 10)));
        }
    }
}
