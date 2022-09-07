<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        "service_type",
        "customer_id",
        "receiver_name",
        "receiver_phone",
        "whatsapp_status",
        "fragile",
        "electronics",
        "location",
        "district",
        "payment_term"
    ];
}
