<?php

namespace App\Console\Commands;

use App\Models\User;
use Hash;
use Illuminate\Console\Command;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hello this is my own php artisan command ';

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
        $input['name'] = $this->ask('Your name?');
        $input['email'] = $this->ask('Your email?');
        $input['password'] = $this->secret('What is the password?');
        $input['password'] = Hash::make($input['password']);

        User::create($input);

        $this->info('User Create Successfully.');
    }
}
