<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminActionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
     protected $postTitle;
    protected $reason;
    protected $postId;

    public function __construct($postTitle, $reason = null, $postId = null)
    {
        $this->postTitle = $postTitle;
        $this->reason = $reason;
        $this->postId = $postId;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_title' => $this->postTitle,
            'reason' => $this->reason,
            'message' => $this->generateMessage(),
            'type' => 'admin_action',
            'timestamp' => now(),
            'post_id' => $this->postId, 
        ];
    }

    protected function generateMessage()
    {
        return $this->reason . ": '{$this->postTitle}'";
    }
}
