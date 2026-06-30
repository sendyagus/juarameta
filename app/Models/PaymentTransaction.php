<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'user_id',
        'project_id',
        'order_id',
        'gross_amount',
        'currency',
        'status',
        'payment_type',
        'snap_token',
        'snap_redirect_url',
        'asset_key',
        'transaction_id',
        'transaction_time',
        'settlement_time',
        'expiry_time',
        'fraud_status',
        'raw_request',
        'raw_response',
        'raw_notification',
    ];

    protected $casts = [
        'raw_request' => 'array',
        'raw_response' => 'array',
        'raw_notification' => 'array',
        'transaction_time' => 'datetime',
        'settlement_time' => 'datetime',
        'expiry_time' => 'datetime',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function isPaid(): bool
    {
        return in_array($this->status, ['paid', 'settlement', 'capture'], true);
    }
}
