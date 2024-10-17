<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearLaravelLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * To run use " docker-compose run --rm artisan logs:clear-laravel-logs "
     * @var string
     */
    protected $signature = 'logs:clear-laravel-logs';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear laravel logs file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        file_put_contents(storage_path('logs/laravel.log'), '');
        $this->info('Logs have been cleared.');
    }
}
