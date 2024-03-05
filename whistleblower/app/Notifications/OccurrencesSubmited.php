<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Http\Request;

class OccurrencesSubmited extends Notification
{
    use Queueable;

    private Request $occurrence;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->occurrence = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
        return [
            'id' => $this->occurrence->id,
            'topic' => $this->occurrence->topic,
            'company_id' => $this->occurrence->company_id,
            'department_id' => $this->occurrence->department_id,
            'category_id' => $this->occurrence->category_id,
            'description' => $this->occurrence->description,
            'classification' => $this->occurrence->classification,
            'url' => route('occurrences.show', $this->occurrence->id)
        ];
    }
}
