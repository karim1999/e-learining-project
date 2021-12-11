<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ApplicationInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'application:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Preparing the DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Generating DB tables');
        $this->call("migrate:fresh");

        $this->info('Seeding the DB');
        $this->call("db:seed");

        $this->info('Initializing the Admin Panel');
        $this->call("admin:install");

        $this->info('Adding the Admin Panel menu');
        $this->call("admin:generate-menu");

        $this->info('The application was initialized successfully!');
        return Command::SUCCESS;
    }
}
