<?php

namespace App\Console\Commands;

use App\Talk;
use App\Vote;
use Illuminate\Console\Command;

class UpdateTalkVotesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotcfp:update-average-votes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and update average vote of submitted talks';

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
        $talks = Talk::all();

        $bar = $this->output->createProgressBar(count($talks));

        $this->info(sprintf('Calculating and updating an "Average Vote" for %d talks.', count($talks)));

        foreach ($talks as $talk) {
            $averageVote = Vote::whereTalkId($talk->id)->avg('vote');

            $talk->average_vote = $averageVote;
            $talk->save();

            $bar->advance();
        }

        $bar->finish();
    }
}
