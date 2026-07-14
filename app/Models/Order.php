<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 use App\Models\Invoice;


class Order extends Model
{

/** Une commande de génère une seule facture (relation 1..1).
 */
public function invoice()
{
    return $this->hasOne(Invoice::class);
}

// N'oublie pas d'ajouter en haut du fichier, avec les autres "use" :

    use HasFactory;

    protected $fillable = [

        'customer_id',
        'user_id',
        'order_number',
        'order_date',
        'status',
        'total_amount',
        'notes',

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getPaidAmountAttribute()
    {
        return $this->payments->sum('amount');
    }

    public function getRemainingAmountAttribute()
    {
        return max(0, $this->total_amount - $this->paid_amount);
    }
}