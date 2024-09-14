<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserFollowed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    
    private $follower;

    public function __construct(User $follower)
    {
        $this->follower = $follower;
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
                    ->line("{$this->follower->name} has followed you!")
                    ->action('View profile', url('/user/'.$this->follower->username))
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
            'message' => "{$this->follower->name} has followed you!",
            'follower_id' => $this->follower->id,
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "{$this->follower->name} has followed you!",
            'follower_id' => $this->follower->id,
        ];
    }
}
