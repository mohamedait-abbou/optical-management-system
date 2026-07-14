<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'invoice_number',
        'issue_date',
        'tax_rate',
        'total_ht',
        'total_ttc',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'tax_rate'   => 'decimal:2',
        'total_ht'   => 'decimal:2',
        'total_ttc'  => 'decimal:2',
    ];

    /**
     * Une facture appartient à une commande.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Génère un numéro de facture unique au format FAC-2026-0001.
     */
    public static function generateInvoiceNumber(): string
    {
        $year = now()->year;
        $lastInvoice = self::whereYear('created_at', $year)->latest('id')->first();

        $nextNumber = $lastInvoice
            ? ((int) substr($lastInvoice->invoice_number, -4)) + 1
            : 1;

        return sprintf('FAC-%d-%04d', $year, $nextNumber);
    }
}