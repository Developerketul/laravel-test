@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-4">

                <div class="small-box bg-info">

                    <div class="inner">

                        <h3>
                            {{ $stats['customers'] }}
                        </h3>

                        <p>
                            {{ __('Customers') }}
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="small-box bg-success">

                    <div class="inner">

                        <h3>
                            {{ $stats['quotations'] }}
                        </h3>

                        <p>
                            {{ __('Quotations') }}
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3>
                            {{ number_format($stats['revenue'],2) }}
                        </h3>

                        <p>
                            {{ __('Revenue') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection