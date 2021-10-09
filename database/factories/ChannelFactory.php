<?php

namespace Database\Factories;

use App\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Channel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'id' => $faker->uuid,
            'user_id' => $faker->numberBetween($min = 1, $max = 10),
            'name' => $faker->realText($maxNbChars = 150, $indexSize = 5),
            'chat' => $faker->realText($maxNbChars = 150, $indexSize = 5),
        ];
    }
}
