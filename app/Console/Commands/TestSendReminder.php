<?php

namespace App\Console\Commands;

use App\Mail\ReservationReminderMail;
use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestSendReminder extends Command
{
    protected $signature = 'test:send-reminder {reservation? : The reservation ID}';

    protected $description = 'Test sending a reservation reminder email';

    public function handle(): void
    {
        $reservationId = $this->argument('reservation');

        if ($reservationId) {
            $reservation = Reservation::with('customer')->find($reservationId);
        } else {
            $reservation = Reservation::with('customer')->latest()->first();
        }

        if (! $reservation) {
            $this->error('Aucune réservation trouvée.');

            return;
        }

        if (! $reservation->customer || ! $reservation->customer->email) {
            $this->error('Le client de cette réservation n\'a pas d\'email.');

            return;
        }

        Mail::to($reservation->customer->email)->send(new ReservationReminderMail($reservation));
        $this->info("Email de rappel envoyé à {$reservation->customer->email} pour le rendez-vous du {$reservation->reservation_date->format('d/m/Y')} à {$reservation->reservation_time}");
    }
}
