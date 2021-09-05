<?php

namespace Database\Factories;

use App\Models\Singer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SingerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Singer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gender'=>$this->faker->titleFemale(),
            'date'=>$this->faker->date(),
            'music_category'=>$this->faker->name(),
            'band'=>$this->faker->name(),
            'description'=>$this->faker->name(),
            'famousSong'=>$this->faker->randomDigitNotNull(),
            'moreInfo'=>$this->faker->randomDigit()
        ];
    }
}
