<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = config('ordik.admin');

        if (blank($admin['email']) || blank($admin['password'])) {
            $this->command->error('Defina ADMIN_EMAIL e ADMIN_PASSWORD no .env para criar o admin.');

            return;
        }

        User::updateOrCreate(
            ['email' => $admin['email']],
            ['name' => $admin['name'], 'password' => $admin['password']],
        );

        $this->command->info("Admin {$admin['email']} pronto.");
    }
}
