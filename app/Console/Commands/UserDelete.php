<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;

class UserDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:all';

    /**
     * The console command description.
     *
     * @var string 
     */
    protected $description = 'Command description';

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
        Student::truncate();
        $this->info('User Deleted Successfully.');
    }
}
