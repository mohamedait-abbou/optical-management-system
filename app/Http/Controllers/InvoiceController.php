<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Liste de toutes les factures générées.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $invoices = Invoice::with('order.customer')
            ->when($search, function ($query, $search) {
                $query->where('invoice_number', 'like', "%{$search}%")
                      ->orWhereHas('order.customer', function ($q) use ($search) {
                          $q->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('invoices.index', compact('invoices', 'search'));
    }

    /**
     * Générer une facture à partir d'une commande existante.
     */
    public function store(Order $order)
    {
        // Empêche de générer deux fois une facture pour la même commande
        if ($order->invoice) {
            return redirect()->route('invoices.show', $order->invoice)
                ->with('error', 'Une facture existe déjà pour cette commande.');
        }

        $taxRate = 20.00;
        $totalTtc = $order->total_amount;
        $totalHt = round($totalTtc / (1 + $taxRate / 100), 2);

        $invoice = Invoice::create([
            'order_id'       => $order->id,
            'invoice_number' => Invoice::generateInvoiceNumber(),
            'issue_date'     => now(),
            'tax_rate'       => $taxRate,
            'total_ht'       => $totalHt,
            'total_ttc'      => $totalTtc,
        ]);

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Facture générée avec succès.');
    }

    /**
     * Afficher le détail d'une facture à l'écran.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('order.customer', 'order.items.product');

        return view('invoices.show', compact('invoice'));
    }

    /**
     * Télécharger la facture au format PDF.
     */
    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load('order.customer', 'order.items.product');

        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'))
            ->setPaper('a4');

        return $pdf->download($invoice->invoice_number . '.pdf');
    }

    /**
     * Supprimer une facture (annulation).
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Facture supprimée avec succès.');
    }
}