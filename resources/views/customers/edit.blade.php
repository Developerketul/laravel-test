@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <x-errors />

        <div class="card">

            <div class="card-header">

                Edit Customer

            </div>

            <div class="card-body">

                <form action="{{ route('customers.update',$customer) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label>Name</label>

                        <input type="text" name="name" class="form-control" value="{{ old('name',$customer->name) }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input type="email" name="email" class="form-control"
                            value="{{ old('email',$customer->email) }}">

                    </div>

                    <div class="mb-3">

                        <label>Phone</label>

                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone',$customer->phone) }}">

                    </div>

                    <div class="mb-3">

                        <label>Address</label>

                        <textarea name="address" class="form-control">{{ old('address',$customer->address) }}</textarea>

                    </div>

                    <button class="btn btn-success">

                        Update

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection