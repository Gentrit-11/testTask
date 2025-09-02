<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;

    class TagFactory extends Factory
    {
        public function definition(): array
        {
            $names = [
                'Backend','Frontend','API','Bug','Enhancement','Urgent','Design','Testing','DevOps','Security',
                'Docs','Performance','Database','UX','Mobile','Analytics','Payments','Auth','Notifications','CI/CD',
            ];

            $colors = ['blue','green','red','orange','teal','purple','indigo','emerald','cyan','rose','gray'];

            return [
                'name'  => $this->faker->unique()->randomElement($names),
                'color' => $this->faker->optional()->randomElement($colors),
            ];
        }
    }
