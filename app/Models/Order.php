<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subtotal',
        'discount',
        'tax',
        'total',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'landmark',
        'zip',
        'type',
        'status',
        'payment_method',
        'payment_status',
        'transaction_id',
        'is_shipping_different',
        'delivered_date',
        'canceled_date',
        'notes'

    ];
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function shipping()
    {

        return $this->hasOne(Shipping::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    // Order.php
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'unit_price')
            ->withTimestamps();
    }
}
