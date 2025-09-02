<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Issue;
    use App\Models\Project;

    class IssueSeeder extends Seeder
    {
        public function run(): void
        {
            $projects = Project::pluck('id');
            Issue::factory()->count(12)->create([
                'project_id' => $projects->random(),
            ]);
        }
    }
