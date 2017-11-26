<?php

namespace App\Console\Commands;

use App\Notifications\RemindLastSubmissionDate;
use App\Talk;
use App\User;
use Illuminate\Console\Command;

class RemindLastSubmissionDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:last-submission-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind last submission date to users who have not submitted proposal(s) yet';

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
     * @return mixed
     */
    public function handle()
    {
        $speakers = Talk::select('user_id')->distinct()->pluck('user_id')->toArray();

        $users = User::whereNotIn('id', $speakers)->where('role', 'user')->get();

        $bar = $this->output->createProgressBar(count($users));

        $this->info(sprintf('Reminder(s) passing to queue for %d users.', count($users)));

        foreach ($users as $user) {
            $user->notify(new RemindLastSubmissionDate($user->name));

            $bar->advance();
        }

        $bar->finish();
    }
}
