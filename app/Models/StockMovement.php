<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'reference',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getTypeBadgeAttribute()
    {
        return $this->type === 'IN'
            ? 'bg-green-100 text-green-700'
            : 'bg-red-100 text-red-700';
    }

    public function getTypeLabelAttribute()
    {
        return $this->type === 'IN'
            ? 'Entrée'
            : 'Sortie';
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhere('reference', 'like', "%{$search}%")
            ->orWhere('type', 'like', "%{$search}%");
    }
}