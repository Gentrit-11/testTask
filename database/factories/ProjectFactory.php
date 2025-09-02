<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;

    class ProjectFactory extends Factory
    {
        public function definition(): array
        {
            $start = $this->faker->dateTimeBetween('-30 days', '+7 days');
            $end   = (clone $start)->modify('+'.rand(7,45).' days');

            return [
                'name'        => $this->faker->company() . ' ' . $this->faker->randomElement(['Portal','Dashboard','App','Platform','Service']),
                'description' => $this->faker->catchPhrase() . '. ' . ucfirst($this->faker->bs()) . '.',
                'start_date'  => $start->format('Y-m-d'),
                'deadline'    => $end->format('Y-m-d'),
            ];
        }
    }
