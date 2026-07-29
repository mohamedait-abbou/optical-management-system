<?php

namespace App\Console\Commands;

use App\Mail\ReservationReminderMail;
use App\Models\Reservation;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReservationReminders extends Command
{
    protected $signature = 'emails:send-reminders';

    protected $description = 'Send email reminders for confirmed reservations 24h before';

    public function handle(): void
    {
        $hoursBefore = (int) Setting::get('appointment_reminder_hours', 24);

        $targetDate = Carbon::now()->addHours($hoursBefore)->toDateString();
        $targetTime = Carbon::now()->addHours($hoursBefore)->format('H:i');

        $reservations = Reservation::with('customer')
            ->where('status', 'confirmed')
            ->where('reservation_date', $targetDate)
            ->where('reservation_time', '<=', $targetTime)
            ->where('reservation_time', '>', Carbon::now()->format('H:i'))
            ->get();

        if ($reservations->isEmpty()) {
            $this->info('Aucun rappel à envoyer.');

            return;
        }

        $sent = 0;
        foreach ($reservations as $reservation) {
            if ($reservation->customer && $reservation->customer->email) {
                Mail::to($reservation->customer->email)->send(new ReservationReminderMail($reservation));
                $sent++;
            }
        }

        $this->info("{$sent} rappel(s) envoyé(s) avec succès.");
    }
}
