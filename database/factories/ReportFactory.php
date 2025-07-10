<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'NameInspection'              => $this->faker->sentence(3),
            'NameInspector'          => $this->faker->name(),
            'Station'            => $this->faker->city(),
            'TypeofInspection' => $this->faker->text(100),
            'Duration'           => $this->faker->numberBetween(1, 12) . ' months',
        ];
    }
}
