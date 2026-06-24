@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <x-flash />
        <x-errors />

        <div class="card">

            <div class="card-header">
                {{ __('Company Settings') }}
            </div>

            <div class="card-body">
                <form action="{{ route('settings.company.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>{{ __('Company Name') }}</label>
                        <input
                            type="text"
                            name="company_name"
                            class="form-control"
                            value="{{ old('company_name', $settings['company_name']) }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label>{{ __('Company Address') }}</label>
                        <textarea
                            name="company_address"
                            class="form-control"
                            rows="3"
                        >{{ old('company_address', $settings['company_address']) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('Company Email') }}</label>
                        <input
                            type="email"
                            name="company_email"
                            class="form-control"
                            value="{{ old('company_email', $settings['company_email']) }}"
                        >
                    </div>

                    <div class="mb-3">
                        <label>{{ __('Company Phone') }}</label>
                        <input
                            type="text"
                            name="company_phone"
                            class="form-control"
                            value="{{ old('company_phone', $settings['company_phone']) }}"
                        >
                    </div>

                    <button class="btn btn-success">{{ __('Save') }}</button>
                </form>
            </div>

        </div>

    </div>

</section>

@endsection
