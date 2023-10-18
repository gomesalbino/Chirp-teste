<?php

namespace App\Notifications;


use App\Models\Chirp;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewChirp extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Chirp $chirpe)
    {
        //
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
    {
        return (new MailMessage)
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');
                    ->subject("New Chirp from {$this->chirpe->user->name}")
                    ->greeting("New Chirp from {$this->chirpe->user->name}")
                    ->line(Str::limit($this->chirpe->message, 50))
                    ->action('Go to Chirper', url('/'))
                    ->line('Obrigado por usar o nosso aplicativo!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
