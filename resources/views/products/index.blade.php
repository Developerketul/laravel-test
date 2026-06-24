@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <x-flash />

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <div>
                    <h3 class="card-title mb-0">{{ __('Products') }}</h3>
                    <p class="text-muted mb-0">{{ __('Showing :count products', ['count' => $products->total()]) }}</p>
                </div>

                <div class="d-flex gap-2">
                    <form method="GET" action="{{ route('products.index') }}" class="d-flex">
                        <input
                            type="search"
                            name="q"
                            value="{{ request('q') }}"
                            class="form-control"
                            placeholder="{{ __('Search products...') }}"
                        >
                        <button type="submit" class="btn btn-secondary ms-2">
                            {{ __('Search') }}
                        </button>
                    </form>

                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        {{ __('Add Product') }}
                    </a>
                </div>

            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-bordered table-hover mb-0 js-datatable">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>{{ __('Name') }}</th>

                            <th>{{ __('SKU') }}</th>

                            <th>{{ __('Unit Price') }}</th>

                            <th>{{ __('Status') }}</th>

                            <th>{{ __('Actions') }}</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($products as $product)

                        <tr>

                            <td>{{ $product->id }}</td>

                            <td>{{ $product->name }}</td>

                            <td>{{ $product->sku }}</td>

                            <td>{{ number_format((float) $product->unit_price, 2) }}</td>

                            <td>
                                <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $product->is_active ? __('Active') : __('Inactive') }}
                                </span>
                            </td>

                            <td>

                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                                    {{ __('Edit') }}
                                </a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure?') }}')">
                                        {{ __('Delete') }}
                                    </button>
                                </form>

                            </td>

                        </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    {{ __('No products found. Try a different search or add a new product.') }}
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card-footer d-flex justify-content-end">
                {{ $products->links() }}
            </div>

        </div>

    </div>

</section>

@endsection
