<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\User;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Notifications\NewReservationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ CETTE LIGNE ÉTAIT MANQUANTE


class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $reservations = Reservation::with('customer')
            ->when($search, function ($query, $search) {
                $query->whereHas('customer', function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%");
                })->orWhere('reason', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('reservations.index', compact('reservations', 'search'));
    }

    public function create(Request $request)
    {
        $customers = Customer::orderBy('first_name')->get();
        $selectedCustomerId = $request->query('customer_id');

        return view('reservations.create', compact('customers', 'selectedCustomerId'));
    }

        public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create($request->validated());

        // ✅ MODIFICATION ICI : Notifie directement l'utilisateur connecté
        $customerName = ($reservation->customer->first_name ?? '') . ' ' . ($reservation->customer->last_name ?? '');
        Auth::user()->notify(new NewReservationNotification($customerName, $reservation->reservation_date->format('d/m/Y')));

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation ajoutée avec succès.');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $customers = Customer::orderBy('first_name')->get();

        return view('reservations.edit', compact('reservation', 'customers'));
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->validated());

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation modifiée avec succès.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation supprimée avec succès.');
    }

    public function calendar()
    {
        return view('reservations.calendar');
    }

    public function events()
    {
        $reservations = Reservation::with('customer')->get();
        $events = [];

        foreach ($reservations as $reservation) {
            switch ($reservation->status) {
                case 'confirmed':
                    $color = '#10b981'; // Green
                    break;
                case 'pending':
                    $color = '#f59e0b'; // Orange
                    break;
                case 'completed':
                    $color = '#3b82f6'; // Blue
                    break;
                case 'cancelled':
                    $color = '#ef4444'; // Red
                    break;
                default:
                    $color = '#6366f1';
            }

            $events[] = [
                'id' => $reservation->id,
                'title' => optional($reservation->customer)->first_name . ' ' . optional($reservation->customer)->last_name,
                'start' => $reservation->reservation_date->format('Y-m-d') . 'T' . $reservation->reservation_time,
                'backgroundColor' => $color,
                'borderColor' => $color,
                'textColor' => '#ffffff',
                'url' => route('reservations.show', $reservation),
            ];
        }

        return response()->json($events);
    }
}