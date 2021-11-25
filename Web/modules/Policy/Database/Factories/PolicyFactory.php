<?php

namespace Modules\Policy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Policy\Models\Policy;

class PolicyFactory extends Factory
{


    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Policy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title'                    => $this->faker->name(),
            'date_uploaded'            => now()->toDateTimeString(),
            'acknowledgement_required' => true,
            'file'                     => $this->faker->imageUrl,
            'file_type'                => 'PNG',
        ];
    }
}
