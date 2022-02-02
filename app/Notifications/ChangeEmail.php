<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeEmail extends Notification
{
    use Queueable;

    public $randomCode;

    public function __construct($randomCode)
    {
        $this->randomCode = $randomCode;

    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        /*return (new MailMessage)
                    ->subject('Verify your email')
                    ->view('emails.updateEmailTemplate', [
                        'notifiable' => $notifiable,
                        'randomCode' => $this->randomCode,
                    ]);*/

        return (new MailMessage)
            ->greeting('Hello!')
            ->subject('Verify your email')
            ->line('Your Verification code is  ' . $this->randomCode . '.');
    }
}
