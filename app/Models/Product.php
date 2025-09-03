<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'sku',
        'image_url',
        'description',
        'price',
        'quantity',
        'is_visible',
        'is_featured',
        'type',
        'published_at',
        'short_description',
        'date_sale_price_ends',
        'tax_status',
        'tax_class',
        'in_stock',
        'low_stock_amount',
        'backorders_allowed',
        'sold_individually',
        'weight',
        'length',
        'width',
        'height',
        'allow_customer_reviews',
        'purchase_note',
        'sale_price',
        'external_url',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_product',
            'product_id',
            'category_id'
        );
    }

    public function orders(): BelongsToMany
    {
        // return $this->belongsToMany(Order::class, 'order_items')
        //     ->using(OrderItem::class)
        //     ->withPivot([
        //         'quantity',
        //         'unit_price',
        //     ]);
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot([
                'quantity',
                'unit_price',
            ]);
    }
}
