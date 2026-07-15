<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewReservationNotification extends Notification
{
    use Queueable;

    public $customerName;
    public $date;

    public function __construct($customerName, $date)
    {
        $this->customerName = $customerName;
        $this->date = $date;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "📅 Nouveau rendez-vous pour {$this->customerName} le {$this->date}.",
            'icon' => 'calendar',
            'link' => route('reservations.index'),
            'color' => 'cyan'
        ];
    }
}