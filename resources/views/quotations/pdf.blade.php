<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('Quotation #:id', ['id' => $quotation->id]) }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.items th,
        table.items td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        table.totals {
            width: 40%;
            margin-top: 15px;
            margin-left: auto;
            border-collapse: collapse;
        }

        table.totals th,
        table.totals td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="title">{{ __('Quotation #:id', ['id' => $quotation->id]) }}</div>
    <table class="header-table">
        <tr>
            <td width="60%">
                <strong>{{ $company['name'] }}</strong><br>
                {{ $company['address'] }}<br>
                {{ $company['email'] }}<br>
                {{ $company['phone'] }}
            </td>
            <td width="40%">
                <strong>{{ __('Customer') }}:</strong> {{ $quotation->customer->name }}<br>
                @if($quotation->project_name)
                    <strong>{{ __('Project / Job') }}:</strong> {{ $quotation->project_name }}<br>
                @endif
                <strong>{{ __('Date') }}:</strong> {{ $quotation->created_at?->format('Y-m-d') }}
            </td>
        </tr>
    </table>
</div>

<table class="items">
    <thead>
    <tr>
        <th>{{ __('Item') }}</th>
        <th>{{ __('Qty') }}</th>
        <th>{{ __('Price') }}</th>
        <th>{{ __('Discount') }}</th>
        <th>{{ __('Tax') }}</th>
        <th>{{ __('Total') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($quotation->items as $item)
        @php
            $base = (float) $item->quantity * (float) $item->unit_price;
            $discount = min((float) $item->discount, $base);
            $taxable = max($base - $discount, 0);
            $tax = $taxable * (((float) $item->tax_percentage) / 100);
        @endphp
        <tr>
            <td>{{ $item->item_name }}</td>
            <td>{{ number_format((float) $item->quantity, 2) }}</td>
            <td>{{ number_format((float) $item->unit_price, 2) }}</td>
            <td>{{ number_format($discount, 2) }}</td>
            <td>{{ number_format($tax, 2) }}</td>
            <td>{{ number_format((float) $item->line_total, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="totals">
    <tr>
        <th>{{ __('Subtotal') }}</th>
        <td>{{ number_format((float) $quotation->subtotal, 2) }}</td>
    </tr>
    <tr>
        <th>{{ __('Discount') }}</th>
        <td>{{ number_format((float) $quotation->discount_total, 2) }}</td>
    </tr>
    <tr>
        <th>{{ __('Total') }}</th>
        <td>{{ number_format((float) ($quotation->subtotal - $quotation->discount_total), 2) }}</td>
    </tr>
    <tr>
        <th>{{ __('Tax') }}</th>
        <td>{{ number_format((float) $quotation->tax_total, 2) }}</td>
    </tr>
    <tr>
        <th>{{ __('Grand Total') }}</th>
        <td><strong>{{ number_format((float) $quotation->grand_total, 2) }}</strong></td>
    </tr>
</table>
</body>
</html>
