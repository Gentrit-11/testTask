<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Comment;
    use App\Models\Issue;

    class CommentSeeder extends Seeder
    {
        public function run(): void
        {
            Issue::pluck('id')->each(function ($issueId) {
                Comment::factory()->count(rand(0,4))->create([
                    'issue_id' => $issueId,
                ]);
            });
        }
    }
