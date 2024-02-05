<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartApp extends Command
{
    protected $signature = 'app:start';
    protected $description = 'Start the Laravel application';

    public function handle()
    {
        $this->info('Installing Composer dependencies...');
        $this->call('composer:install');

        $this->info('Running database migrations...');
        $this->call('migrate');

        $this->info('Seeding the database...');
        $this->call('db:seed', [
            '--class' => 'UsersTableSeeder',
        ]);

        $this->info('Starting the application...');

        $this->call('config:cache');

        // Start the Laravel development server
        $this->call('serve');

        $this->info('Application started.');
    }
}

