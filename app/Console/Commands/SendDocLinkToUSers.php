<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\user;

class SendDocLinkToUSers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:send_doc_link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send doc link to users 1 day after registration';

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
        User::whereNotNull('email_verified_at')
            ->whereDate('created_at',now()->subDays())
            ->get()->each(function($user){
                $user->notify(new SendDocLinkNotification());
        });
    }
}
