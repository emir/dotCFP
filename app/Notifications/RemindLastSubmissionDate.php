<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RemindLastSubmissionDate extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var
     */
    protected $userName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     * @throws \LogicException
     */
    public function toMail($notifiable)
    {
        $today = Carbon::today(config('dotcfp.timezone'));
        $lastSubmissionDate = Carbon::createFromFormat('Y-m-d', config('dotcfp.cfp_end_date'), config('dotcfp.timezone'))->endOfDay();

        if ($lastSubmissionDate->isYesterday()) {
            throw new \LogicException('CFP submissions has been ended.');
        }

        if ($lastSubmissionDate->isToday()) {
            $subject = sprintf('Today is the last day for %s CFP Submissions', config('dotcfp.event_name'));
        } else {
            $subject = sprintf('Last %d days for %s CFP Submissions', (int)ceil($lastSubmissionDate->diffInHours($today) / 24), config('dotcfp.event_name'));
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting(sprintf('Hello, %s', $this->userName))
            ->line(sprintf('You are registered but haven\'t send your proposal(s) yet. %s submissions were accepted until %s. Please get involved!', config('dotcfp.event_name'), (new \DateTime(config('dotcfp . cfp_end_date')))->format('M d, Y')))
            ->action('Submit your talk(s)!', route('talks.create'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
