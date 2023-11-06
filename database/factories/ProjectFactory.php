<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()

    {
        $type_ids = Type::all()->pluck('id');
        $type_ids[] = null;

        $title = fake()->catchPhares();
        $type_id = fake()->randomElement($type_ids);                                                              
        $description = fake()->paragraph(2, true);
        $link =fake()->url();
        $date= fake()->dateTime();

        return [
            'title'=> $title,
            'type_id'  => $type_id,
            'description' => $description,
            'link' => $link,
            'date' => $date,
        ];
    }
}
