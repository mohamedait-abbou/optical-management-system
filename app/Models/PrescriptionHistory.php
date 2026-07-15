<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionHistory extends Model


{
    protected $table = 'prescription_history';
    protected $fillable = [
        'customer_id',
        'user_id',
        'examination_date',
        'od_sphere',
        'od_cylinder',
        'od_axis',
        'od_addition',
        'od_pd',
        'og_sphere',
        'og_cylinder',
        'og_axis',
        'og_addition',
        'og_pd',
        'pd_total',
        'vision_type',
        'notes',
        'diagnosis',
    ];

    protected $casts = [
        'examination_date' => 'date',
        'od_sphere' => 'decimal:2',
        'od_cylinder' => 'decimal:2',
        'og_sphere' => 'decimal:2',
        'og_cylinder' => 'decimal:2',
        'od_addition' => 'decimal:2',
        'og_addition' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function optician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Helper to format prescription value
    public function formatValue($value)
    {
        if (is_null($value)) return '-';
        return ($value > 0 ? '+' : '') . number_format($value, 2);
    }
}