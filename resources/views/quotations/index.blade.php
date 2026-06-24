@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <a href="{{ route('quotations.create') }}" class="btn btn-primary">

                    {{ __('Create Quotation') }}

                </a>

            </div>

            <div class="card-body">

                <table class="table table-bordered js-datatable">

                    <thead>

                        <tr>

                            <th>{{ __('ID') }}</th>

                            <th>{{ __('Customer') }}</th>

                            <th>{{ __('Total') }}</th>

                            <th>{{ __('Date') }}</th>

                            <th>{{ __('Actions') }}</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($quotations as $quotation)

                        <tr>

                            <td>{{ $quotation->id }}</td>

                            <td>{{ $quotation->customer->name }}</td>

                            <td>{{ $quotation->grand_total }}</td>

                            <td>{{ $quotation->created_at }}</td>

                            <td>
                                <a href="{{ route('quotations.preview',$quotation) }}" class="btn btn-primary btn-sm js-preview-popup">
                                    {{ __('Preview') }}
                                </a>

                                <a href="{{ route('quotations.download',$quotation) }}" class="btn btn-success btn-sm">
                                    {{ __('Download PDF') }}
                                </a>

                                <a href="{{ route('quotations.show',$quotation) }}" class="btn btn-info btn-sm">

                                    {{ __('View') }}

                                </a>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

                {{ $quotations->links() }}

            </div>

        </div>

    </div>

</section>

@endsection