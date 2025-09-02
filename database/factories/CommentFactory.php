<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\Issue;

    class CommentFactory extends Factory
    {
        public function definition(): array
        {
            $lines = [
                'I can reproduce this on staging.',
                'Working on it now, will push a fix.',
                'Please review the PR when you can.',
                'Let’s add a regression test for this.',
                'Blocked by missing credentials.',
                'Fixed locally, verifying on staging.',
            ];

            return [
                'issue_id'    => Issue::factory(),
                'author_name' => $this->faker->firstName(),
                'body'        => $this->faker->randomElement($lines),
            ];
        }
    }
