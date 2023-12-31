<?php

namespace App\Console\Commands;
use App\Models\User;
use Notifications;
use App\Notifications\NewsLetterNotification;

use Illuminate\Console\Command;

class SendNewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter notifications to all users';

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
        $users = User::where('is_subscribe_to_newsletters', true)->get();
        
        foreach ($users as $user) {
            // Send the newsletter notification to each user
            $user->notify(new NewsLetterNotification());
        }

        $this->info('Newsletter notifications sent to all users.');
    }
}
