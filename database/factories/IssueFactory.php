<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\Project;

    class IssueFactory extends Factory
    {
        public function definition(): array
        {
            $statuses   = ['open','in_progress','closed'];
            $priorities = ['low','medium','high'];

            return [
                'project_id'  => Project::factory(),
                'title'       => $this->faker->randomElement(['Bug','Task','Improvement','Refactor','Chore'])
                    . ': ' . $this->faker->catchPhrase(),
                'description' => $this->faker->catchPhrase() . '. ' . ucfirst($this->faker->bs()) . '.',
                'status'      => $this->faker->randomElement($statuses),
                'priority'    => $this->faker->randomElement($priorities),
                'due_date'    => $this->faker->optional()->dateTimeBetween('now', '+20 days')?->format('Y-m-d'),
            ];
        }
    }
