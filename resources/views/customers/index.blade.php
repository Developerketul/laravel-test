@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <x-flash />

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h3 class="card-title mb-0">{{ __('Customers') }}</h3>
                <p class="text-muted mb-0">{{ __('Showing :count customers', ['count' => $customers->total()]) }}</p>
            </div>

            <div class="d-flex gap-2">
                <form method="GET" action="{{ route('customers.index') }}" class="d-flex">
                    <input
                        type="search"
                        name="q"
                        value="{{ request('q') }}"
                        class="form-control"
                        placeholder="{{ __('Search customers...') }}"
                    >
                    <button type="submit" class="btn btn-secondary ms-2">
                        {{ __('Search') }}
                    </button>
                </form>

                <a href="{{ route('customers.create') }}" class="btn btn-primary">
                    {{ __('Add Customer') }}
                </a>
            </div>

        </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-bordered table-hover mb-0 js-datatable">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>{{ __('Name') }}</th>

                            <th>{{ __('Email') }}</th>

                            <th>{{ __('Phone') }}</th>

                            <th>{{ __('Actions') }}</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($customers as $customer)

                        <tr>

                            <td>{{ $customer->id }}</td>

                            <td>{{ $customer->name }}</td>

                            <td>{{ $customer->email }}</td>

                            <td>{{ $customer->phone }}</td>

                            <td>

                                <a href="{{ route('customers.edit',$customer) }}" class="btn btn-warning btn-sm">
                                    {{ __('Edit') }}
                                </a>

                                <form action="{{ route('customers.destroy',$customer) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">

                                        {{ __('Delete') }}

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    {{ __('No customers found. Try a different search or add a new customer.') }}
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

                {{ $customers->links() }}

            </div>

        </div>

    </div>

</section>

@endsection