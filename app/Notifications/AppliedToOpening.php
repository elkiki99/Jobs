<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppliedToOpening extends Notification
// implements ShouldQueue
{
    use Queueable;

    private $opening;
    private $candidate;

    /**
     * Create a new notification instance.
     *
     * @param $opening
     */
    public function __construct($opening, $candidate)
    {
        $this->opening = $opening;
        $this->candidate = $candidate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line("A new application has been submitted for the opening titled: {$this->opening->title}.")
            ->action('View Opening', url("/openings/{$this->opening->slug}"))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "A new application has been submitted by {$this->candidate->name} for the opening titled {$this->opening->title}",
            'opening_id' => $this->opening->id,
            'opening_slug' => $this->opening->slug,
            'user_id' => $notifiable->id,
            'candidate_id' => $this->candidate->id,
            'candidate_avatar' => $this->candidate,
            'candidate_username' => $this->candidate->username,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "A new application has been submitted by {$this->candidate->name} for the opening titled {$this->opening->title}.",
            'opening_id' => $this->opening->id,
            'opening_slug' => $this->opening->slug,
            'user_id' => $notifiable->id,
            'candidate_id' => $this->candidate->id,
            'candidate_avatar' => $this->candidate,
            'candidate_username' => $this->candidate->username,
        ];
    }
}
