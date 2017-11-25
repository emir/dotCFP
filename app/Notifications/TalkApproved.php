<?php

namespace App\Notifications;

use App\Talk;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TalkApproved extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Talk
     */
    protected $talk;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Talk $talk)
    {
        $this->talk = $talk;
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
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(sprintf('About %s CFP', config('dotcfp.event_name')))
            ->line('We would like to thank you sincerely for your proposal.')
            ->line(sprintf('Your "%s" talk is approved. We will be contacting you as soon as possible about other details.', $this->talk->title))
            ->action('Visit Website', config('dotcfp.event_site'));
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
