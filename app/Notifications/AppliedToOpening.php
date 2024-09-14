<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppliedToOpening extends Notification implements ShouldQueue
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line("New application by {$this->candidate->name} submitted for {$this->opening->title}")
            ->action('View candidate', url("/user/{$this->candidate->slug}"))
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
            'message' => "New application by {$this->candidate->name} submitted for {$this->opening->title}",
            'opening_id' => $this->opening->id,
            'candidate_id' => $this->candidate->id,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "New application by {$this->candidate->name} submitted for {$this->opening->title}",
            'opening_id' => $this->opening->id,
            'candidate_id' => $this->candidate->id,
        ];
    }
}

