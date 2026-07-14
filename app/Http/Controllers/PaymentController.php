<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Enregistrer un nouveau paiement pour une commande donnée.
     */
    public function store(StorePaymentRequest $request, Order $order)
    {
        $order->payments()->create($request->validated());

        return redirect()->route('orders.show', $order)
            ->with('success', 'Paiement enregistré avec succès.');
    }

    /**
     * Supprimer un paiement (en cas d'erreur de saisie).
     */
    public function destroy(Order $order, Payment $payment)
    {
        // Sécurité : vérifier que ce paiement appartient bien à cette commande
        if ($payment->order_id !== $order->id) {
            abort(403);
        }

        $payment->delete();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Paiement supprimé avec succès.');
    }
}