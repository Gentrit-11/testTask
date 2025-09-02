<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Issue;
    use App\Models\Tag;

    class DatabaseSeeder extends Seeder
    {
        public function run(): void
        {
            $this->call([
                ProjectSeeder::class,
                IssueSeeder::class,
                TagSeeder::class,
                CommentSeeder::class,
            ]);

            Issue::query()->each(function ($issue) {
                $tagIds = Tag::inRandomOrder()->take(rand(0,3))->pluck('id');
                $issue->tags()->syncWithoutDetaching($tagIds);
            });
        }
    }
