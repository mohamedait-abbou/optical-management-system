<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'brand_id',
        'category_id',
        'price',
        'cost_price',
        'quantity',
        'alert_threshold',
        'image',
        'description',
    ];

    protected $casts = [
        'price'      => 'decimal:2',
        'cost_price' => 'decimal:2',
    ];

    /**
     * Un produit appartient à une catégorie.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
{
    return $this->belongsTo(Brand::class);
}

    /**
     * Vérifie si le stock est faible.
     */
    public function isLowStock(): bool
    {
        return $this->quantity <= $this->alert_threshold;
    }

    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
public function stockMovements()
{
    return $this->hasMany(StockMovement::class);
}

    // Relation à venir (Jour 6) :
    // public function orderItems()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }
}