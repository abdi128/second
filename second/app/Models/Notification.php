<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 
        'recipient_id', 
        'recipient_type',
        'type',
        'content',
        'sent_date',
        'status',
    ];

    public function notificationRecipient()
    {
        return $this->morphTo();
    }
}
