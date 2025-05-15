<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database']; // ou ['mail', 'database']
    }

    public function toDatabase($notifiable)
    {
        return [
            'sender_id' => $this->message->sender_id,
            'message' => $this->message->content,
        ];
    }
}
