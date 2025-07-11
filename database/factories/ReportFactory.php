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
            'NameInspection'   => $this->faker->sentence(3),
            'NameInspector'    => $this->faker->name(),
            'Station'          => $this->faker->randomElement([
                'Surat', 'Vadodara', 'Ahmedabad', 'Mumbai Central', 'Howrah', 'Chennai Central',
                'New Delhi', 'Secunderabad', 'Patna', 'Bhopal', 'Nagpur', 'Lucknow',
                'Kanpur Central', 'Jaipur', 'Ernakulam', 'Kolkata', 'Pune', 'Bangalore City', 'Ranchi',
            ]),
            'TypeofInspection' => 'Causal',
            'Duration'         => $this->faker->randomElement(['1 months', '3 months', '6 months']),
        ];
    }

}
