<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    public $productName;
    public $quantity;

    public function __construct($productName, $quantity)
    {
        $this->productName = $productName;
        $this->quantity = $quantity;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "⚠️ Alerte Stock: Le produit '{$this->productName}' est en rupture (Reste: {$this->quantity}).",
            'icon' => 'alert',
            'link' => route('products.index'),
            'color' => 'rose'
        ];
    }
}