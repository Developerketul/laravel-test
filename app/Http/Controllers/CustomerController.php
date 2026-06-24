<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('q')) {
            $query->where(
                'name',
                'like',
                "%{$request->q}%"
            );
        }

        $customers = $query->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'customers.index',
            compact('customers')
        );
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(
        StoreCustomerRequest $request
    ) {

        Customer::create(
            $request->validated()
        );

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                __('Customer created successfully.')
            );
    }

    public function edit(
        Customer $customer
    ) {

        return view(
            'customers.edit',
            compact('customer')
        );
    }

    public function update(
        UpdateCustomerRequest $request,
        Customer $customer
    ) {

        $customer->update(
            $request->validated()
        );

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                __('Customer updated successfully.')
            );
    }

    public function destroy(
        Customer $customer
    ) {

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                __('Customer deleted successfully.')
            );
    }

    public function restore($id)
    {
        Customer::withTrashed()
            ->findOrFail($id)
            ->restore();

        return back()
            ->with(
                'success',
                __('Customer restored.')
            );
    }

    public function search(Request $request)
    {
        $term = $request->q;

        return Customer::query()

            ->select(
                'id',
                'name'
            )

            ->when(
                $term,
                fn($q) =>
                    $q->where(
                        'name',
                        'like',
                        "%{$term}%"
                    )
            )

            ->limit(20)

            ->get()

            ->map(fn($customer) => [

                'id' => $customer->id,

                'text' => $customer->name

            ]);
    }
}