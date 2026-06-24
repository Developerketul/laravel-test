<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Support\Facades\DB;

class QuotationService
{
    public function create(
        array $data
    ): Quotation {

        return DB::transaction(
            function () use ($data) {

                $productIds = collect($data['items'])
                    ->pluck('product_id')
                    ->filter()
                    ->unique()
                    ->values();

                $products = Product::query()
                    ->whereIn('id', $productIds)
                    ->get(['id', 'name'])
                    ->keyBy('id');

                $subtotal = 0;
                $discountTotal = 0;
                $taxTotal = 0;

                foreach (
                    $data['items']
                    as $item
                ) {

                    $product = $products->get($item['product_id'] ?? null);

                    $itemName = $item['item_name']
                        ?? ($product?->name ?? 'Item');

                    $base =
                        $item['quantity']
                        *
                        $item['unit_price'];

                    $discount =
                        $item['discount']
                        ?? 0;

                    $discount = min($discount, $base);

                    $taxableAmount = max($base - $discount, 0);

                    $tax =
                        $taxableAmount
                        *
                        (
                            ($item['tax_percentage'] ?? 0)
                            /100
                        );

                    $subtotal += $base;
                    $discountTotal += $discount;
                    $taxTotal += $tax;
                }

                $grandTotal =
                    $subtotal
                    -
                    $discountTotal
                    +
                    $taxTotal;

                $quotation =
                    Quotation::create([

                        'customer_id' =>
                            $data['customer_id'],

                        'project_name' =>
                            $data['project_name'] ?? null,

                        'subtotal' =>
                            $subtotal,

                        'discount_total' =>
                            $discountTotal,

                        'tax_total' =>
                            $taxTotal,

                        'grand_total' =>
                            $grandTotal,

                        'created_by' =>
                            auth()->id()
                    ]);

                foreach (
                    $data['items']
                    as $item
                ) {

                    $product = $products->get($item['product_id'] ?? null);

                    $itemName = $item['item_name']
                        ?? ($product?->name ?? 'Item');

                    $base =
                        $item['quantity']
                        *
                        $item['unit_price'];

                    $discount =
                        $item['discount']
                        ?? 0;

                    $discount = min($discount, $base);

                    $taxableAmount = max($base - $discount, 0);

                    $tax =
                        $taxableAmount
                        *
                        (
                            ($item['tax_percentage'] ?? 0)
                            /100
                        );

                    $quotation
                        ->items()
                        ->create([

                            'product_id' =>
                                $item['product_id']
                                ?? null,

                            'item_name' =>
                                $itemName,

                            'quantity' =>
                                $item['quantity'],

                            'unit_price' =>
                                $item['unit_price'],

                            'discount' =>
                                $discount,

                            'tax_percentage' =>
                                $item['tax_percentage']
                                ?? 0,

                            'line_total' =>
                                $taxableAmount
                                +
                                $tax
                        ]);
                }

                return $quotation;
            }
        );
    }
}