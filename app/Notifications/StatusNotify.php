<?php

namespace App\Notifications;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusNotify extends Notification
{
    use Queueable;
    private $contact,$user;
    /**
     * Create a new notification instance.
     */
    public function __construct(Contact $contact, User $user)
    {
        $this->contact = $contact;
        $this->user = $user;
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
    public function toMail($notifiable)
    {
        $data = $this->toArray($this->contact);
        $user = $this->toStatus($this->user);
        return (new MailMessage)
            ->subject('Response request')
            ->greeting('Request form by ' . $user['name'])
            ->line($data['content'])
            ->line('Status:' . $data['message'])
            ->action('WSM', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $stt = [
            1 => 'Yêu cầu mới',
            2 => 'Đã Xác nhận',
            3 => 'Đồng ý',
            4 => 'Từ chối',
            5 => 'Hủy',
        ];
        $content=[
            "days_on"=>"Nghỉ phép có lương",
            "days_off"=>"Nghỉ phép không lương",
            "over_time"=>"Làm thêm giờ",
        ];
        $notifiable->message = $stt[$notifiable->status];
        $notifiable->ct=$content[$notifiable->content];
        return [
            'message' => $notifiable->message,
            'content' => $notifiable->ct
        ];
    }
    public function toStatus($notifiable)
    {
        return [
            'email' => $notifiable->email,
            'name' => $notifiable->name,
        ];
    }
}
