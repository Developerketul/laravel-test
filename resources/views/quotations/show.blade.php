@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                {{ __('Quotation #:id', ['id' => $quotation->id]) }}

                <div class="float-end">
                    <a href="{{ route('quotations.preview', $quotation) }}" class="btn btn-primary btn-sm js-preview-popup">
                        {{ __('Preview') }}
                    </a>
                    <a href="{{ route('quotations.download', $quotation) }}" class="btn btn-success btn-sm">
                        {{ __('Download PDF') }}
                    </a>
                </div>

            </div>

            <div class="card-body">

                <p>

                    {{ __('Customer') }}:

                    {{ $quotation->customer->name }}

                </p>
                @if($quotation->project_name)
                <p>
                    {{ __('Project / Job') }}:
                    {{ $quotation->project_name }}
                </p>
                @endif

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>{{ __('Item') }}</th>

                            <th>{{ __('Qty') }}</th>

                            <th>{{ __('Price') }}</th>

                            <th>{{ __('Total') }}</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($quotation->items as $item)

                        <tr>

                            <td>{{ $item->item_name }}</td>

                            <td>{{ $item->quantity }}</td>

                            <td>{{ $item->unit_price }}</td>

                            <td>{{ $item->line_total }}</td>

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