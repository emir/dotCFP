<?php

namespace App\Console\Commands;

use App\Notifications\RemindSubmissionsEnded;
use App\User;
use Illuminate\Console\Command;

class RemindSubmissionsEndedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:submission-ended';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind submission ended to conference committee';

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
        $committee = User::committee()->get();

        $bar = $this->output->createProgressBar(count($committee));

        $this->info(sprintf('Reminder(s) passing to queue for %d users.', count($committee->count())));

        foreach ($committee as $user) {
            $user->notify(new RemindSubmissionsEnded($user->name));

            $bar->advance();
        }

        $bar->finish();
    }
}
