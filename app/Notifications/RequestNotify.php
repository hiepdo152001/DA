<?php

namespace App\Notifications;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use PhpParser\Node\Expr\Cast\Object_;

class RequestNotify extends Notification
{
    use Queueable;
    private $contact, $user;
    /**
     * Create a new notification instance.
     */
    public function __construct(Contact $contact, User $user)
    {
        $this->contact=$contact;
        $this->user= $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {   $data=$this->toArray($this->contact);
        return (new MailMessage)
                    ->line('new contact')
                    ->line($data['content'])
                    ->action('Notification Action', url('/'))
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
            'email'=>$notifiable->email,
            'content'=>$notifiable->content,
        ];
    }
}
