@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <x-errors />

        <div class="card">

            <div class="card-header">

                {{ __('Edit Product') }}

            </div>

            <div class="card-body">

                <form action="{{ route('products.update', $product) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('SKU') }}</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('Unit Price') }}</label>
                        <input type="number" step="0.01" min="0" name="unit_price" class="form-control" value="{{ old('unit_price', $product->unit_price) }}" required>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('Description') }}</label>
                        <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            {{ __('Active') }}
                        </label>
                    </div>

                    <button class="btn btn-success">
                        {{ __('Update') }}
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection
