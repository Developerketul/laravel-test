<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class QuotationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'product_id',
        'item_name',
        'quantity',
        'unit_price',
        'discount',
        'tax_percentage',
        'line_total'
    ];

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(
            Quotation::class
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(
            Product::class
        );
    }
}