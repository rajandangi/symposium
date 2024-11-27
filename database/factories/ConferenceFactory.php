<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conference>
 */
class ConferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = now()->addMonths(6); // 6 months from now
        $endsAt = $startsAt->clone()->addDays(3); // 3 days later from the start date
        $cfpStartsAt = $startsAt->clone()->subMonths(4); // 4 months before the start date
        $cfpEndsAt = $cfpStartsAt->clone()->addMonths(2); // 2 months later from the CFP start date

        return [
            'title' => fake()->sentence(),
            'location' => fake()->city() . ', ' . fake()->country(),
            'description' => fake()->paragraph(),
            'url' => fake()->url(),
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'cfp_starts_at' => $cfpStartsAt,
            'cfp_ends_at' => $cfpEndsAt,
        ];
    }
}
