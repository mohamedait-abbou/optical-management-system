<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'doctor_name',
        'prescription_date',
        'right_sphere',
        'right_cylinder',
        'right_axis',
        'left_sphere',
        'left_cylinder',
        'left_axis',
        'pd',
        'addition',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}