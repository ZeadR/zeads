<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Job;
use App\Models\Application;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users
        $super = User::factory()->create(['name' => 'Super Admin', 'username'=>'super', 'email' => 'super@talentsync.test', 'password' => bcrypt('123456')]);
        $admin = User::factory()->create(['name' => 'Admin', 'username'=>'admin', 'email' => 'admin@talentsync.test', 'password' => bcrypt('123456')]);
        $employer = User::factory()->create(['name' => 'Employer', 'username'=>'employer', 'email' => 'employer@talentsync.test', 'password' => bcrypt('123456')]);
        $seeker = User::factory()->create(['name' => 'Job Seeker', 'username'=>'user', 'email' => 'seeker@talentsync.test', 'password' => bcrypt('123456')]);

        // Extra employers and users
        $employer2 = User::factory()->create(['name' => 'Employer Two', 'username'=>'employer2', 'email' => 'employer2@talentsync.test', 'password' => bcrypt('123456')]);
        $employer3 = User::factory()->create(['name' => 'Employer Three', 'username'=>'employer3', 'email' => 'employer3@talentsync.test', 'password' => bcrypt('123456')]);
        $user2 = User::factory()->create(['name' => 'User Two', 'username'=>'user2', 'email' => 'user2@talentsync.test', 'password' => bcrypt('123456')]);
        $user3 = User::factory()->create(['name' => 'User Three', 'username'=>'user3', 'email' => 'user3@talentsync.test', 'password' => bcrypt('123456')]);

        $super->assignRole('Super Admin');
        $admin->assignRole('Admin');
        foreach ([$employer, $employer2, $employer3] as $emp) { $emp->assignRole('Employer'); }
        foreach ([$seeker, $user2, $user3] as $usr) { $usr->assignRole('Job Seeker'); }

        // Profiles
        foreach ([$super, $admin, $employer, $seeker, $employer2, $employer3, $user2, $user3] as $u) {
            Profile::create([
                'user_id' => $u->id,
                'bio' => 'Demo user',
                'skills' => 'PHP,Laravel,Vue,MySQL',
                'location' => 'Remote',
            ]);
        }

        // Jobs
        $jobs = [];
        $jobs[] = Job::create([
            'employer_id' => $employer->id,
            'title' => 'Laravel Developer',
            'company' => 'TalentSync Co',
            'location' => 'Remote',
            'type' => 'Full-time',
            'salary_min' => 60000,
            'salary_max' => 90000,
            'category' => 'Software',
            'is_featured' => true,
            'description' => 'Build and maintain Laravel apps.',
        ]);
        $jobs[] = Job::create([
            'employer_id' => $employer->id,
            'title' => 'Frontend Engineer',
            'company' => 'TalentSync Co',
            'location' => 'Dhaka',
            'type' => 'Contract',
            'salary_min' => 30000,
            'salary_max' => 60000,
            'category' => 'Software',
            'is_featured' => false,
            'description' => 'Work on modern UIs.',
        ]);
        $jobs[] = Job::create([
            'employer_id' => $employer2->id,
            'title' => 'QA Engineer',
            'company' => 'QualityWorks',
            'location' => 'Chittagong',
            'type' => 'Full-time',
            'salary_min' => 25000,
            'salary_max' => 45000,
            'category' => 'QA',
            'is_featured' => false,
            'description' => 'Ensure product quality.',
        ]);
        $jobs[] = Job::create([
            'employer_id' => $employer3->id,
            'title' => 'DevOps Engineer',
            'company' => 'CloudSync',
            'location' => 'Remote',
            'type' => 'Full-time',
            'salary_min' => 70000,
            'salary_max' => 110000,
            'category' => 'DevOps',
            'is_featured' => true,
            'description' => 'CI/CD and infrastructure.',
        ]);

        // Example applications
        Application::create(['job_id' => $jobs[0]->id, 'user_id' => $seeker->id]);
        Application::create(['job_id' => $jobs[1]->id, 'user_id' => $user2->id]);
        Application::create(['job_id' => $jobs[2]->id, 'user_id' => $user3->id]);
    }
}
