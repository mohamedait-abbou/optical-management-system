<?php

namespace App\Console\Commands;

use App\Mail\OrderReadyMail;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestSendOrderReady extends Command
{
    protected $signature = 'test:order-ready {order? : The order ID}';

    protected $description = 'Test sending the order ready email';

    public function handle(): void
    {
        $orderId = $this->argument('order');

        if ($orderId) {
            $order = Order::with('customer')->find($orderId);
        } else {
            $order = Order::with('customer')->latest()->first();
        }

        if (! $order) {
            $this->error('Aucune commande trouvée.');

            return;
        }

        if (! $order->customer || ! $order->customer->email) {
            $this->error('Le client de cette commande n\'a pas d\'email.');

            return;
        }

        Mail::to($order->customer->email)->send(new OrderReadyMail($order));
        $this->info("Email 'Commande prête' envoyé à {$order->customer->email} pour la commande #{$order->order_number}");
    }
}
