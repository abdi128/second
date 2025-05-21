<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admin_id',
        'service_description',
        'amount',
        'issued_date',
        'payment',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
