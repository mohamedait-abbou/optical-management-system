<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $orderNumber;
    public $customerName;

    public function __construct($orderNumber, $customerName)
    {
        $this->orderNumber = $orderNumber;
        $this->customerName = $customerName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "🛒 Nouvelle commande #{$this->orderNumber} créée par {$this->customerName}.",
            'icon' => 'cart',
            'link' => route('orders.index'),
            'color' => 'indigo'
        ];
    }
}