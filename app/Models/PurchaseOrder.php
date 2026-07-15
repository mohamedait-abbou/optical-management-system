<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    protected $fillable = ['supplier_id', 'order_number', 'order_date', 'expected_date', 'status', 'total_amount', 'notes'];

    protected $casts = ['order_date' => 'date', 'expected_date' => 'date'];

    public function supplier(): BelongsTo { return $this->belongsTo(Supplier::class); }
    public function items(): HasMany { return $this->hasMany(PurchaseOrderItem::class); }
}