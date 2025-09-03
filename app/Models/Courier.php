<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'ep_name',
        'pick_contact_person',
        'pick_district',
        'pick_thana',
        'pick_hub',
        'pick_union',
        'pick_address',
        'pick_mobile',
        'recipient_name',
        'recipient_mobile',
        'recipient_district',
        'recipient_city',
        'recipient_area',
        'recipient_thana',
        'recipient_union',
        'recipient_zip',
        'package_code',
        'recipient_address',
        'parcel_detail',
        'number_of_item',
        'product_price',
        'payment_method',
        'ep_id',
        'product_id',
        'actual_product_price',
        'status',
        'tracking_number',
        'ecr',
        'is_cancel',
        'comment',
        'order_id',
        'customer_id',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }


}
