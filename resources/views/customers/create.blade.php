@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <x-errors />

        <div class="card">

            <div class="card-header">

                Create Customer

            </div>

            <div class="card-body">

                <form action="{{ route('customers.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label>Name</label>

                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">

                    </div>

                    <div class="mb-3">

                        <label>Phone</label>

                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">

                    </div>

                    <div class="mb-3">

                        <label>Address</label>

                        <textarea name="address" class="form-control">{{ old('address') }}</textarea>

                    </div>

                    <button class="btn btn-success">

                        Save

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection