@extends('layouts.app')

@section('content')

<section class="content pt-3">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>{{ __('Quotation #:id', ['id' => $quotation->id]) }}</span>
                <a href="{{ route('quotations.download', $quotation) }}" class="btn btn-success btn-sm">
                    {{ __('Download PDF') }}
                </a>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>{{ $company['name'] }}</h5>
                        <div>{{ $company['address'] }}</div>
                        <div>{{ $company['email'] }}</div>
                        <div>{{ $company['phone'] }}</div>
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>{{ __('Customer') }}:</strong> {{ $quotation->customer->name }}<br>
                        @if($quotation->project_name)
                            <strong>{{ __('Project / Job') }}:</strong> {{ $quotation->project_name }}
                        @endif
                    </div>
                </div>

                <table class="table table-bordered">
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

                <div class="row mt-3">
                    <div class="col-md-4 ms-auto">
                        <table class="table">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
