<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EventReminderNotification extends Notification
{
    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Rappel : Événement à venir')
            ->line('Nous vous rappelons que l\'événement "' . $this->event->name . '" aura lieu le ' . $this->event->date . '.')
            ->action('Voir l\'événement', route('events.show', $this->event->id))
            ->line('Nous avons hâte de vous y voir !');
    }
}
