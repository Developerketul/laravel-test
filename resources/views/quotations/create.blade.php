@extends('layouts.app')

@section('content')

<section class="content pt-3">

    <div class="container-fluid">

        <x-errors />

        <div class="card">

            <div class="card-header">

                {{ __('Create Quotation') }}

            </div>

            <div class="card-body">

                <form action="{{ route('quotations.store') }}" method="POST">

                    @csrf

                    @include('quotations.partials.customer')

                    @include('quotations.partials.items')

                    @include('quotations.partials.summary')

                    <button type="submit" class="btn btn-success mt-3">

                        {{ __('Save') }}

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

@push('scripts')
<script>
    (function () {
        const products = @json($productsForJs);

        const productOptionsHtml = products.map((product) => (
            `<option value="${product.id}" data-name="${product.name}">${product.name}</option>`
        )).join('');

        const itemsBody = document.getElementById('items-body');
        const subtotalEl = document.getElementById('subtotal');
        const discountTotalEl = document.getElementById('discount-total');
        const netTotalEl = document.getElementById('net-total');
        const taxTotalEl = document.getElementById('tax-total');
        const grandTotalEl = document.getElementById('grand-total');
        let itemIndex = 0;

        const formatAmount = (value) => Number(value || 0).toFixed(2);

        const createItemRow = (index) => {
            const tr = document.createElement('tr');
            tr.className = 'item-row';
            tr.innerHTML = `
                <td>
                    <select name="items[${index}][product_id]" class="form-control item-product" required>
                        <option value="">{{ __('Select product') }}</option>
                        ${productOptionsHtml}
                    </select>
                    <input type="hidden" name="items[${index}][item_name]" class="item-name-hidden">
                </td>
                <td>
                    <input type="number" name="items[${index}][quantity]" class="form-control item-quantity" min="1" value="1" required>
                </td>
                <td>
                    <input type="number" step="0.01" name="items[${index}][unit_price]" class="form-control item-unit-price" min="0" value="0.00" required>
                </td>
                <td>
                    <input type="number" step="0.01" name="items[${index}][discount]" class="form-control item-discount" min="0" value="0.00">
                </td>
                <td>
                    <input type="number" step="0.01" name="items[${index}][tax_percentage]" class="form-control item-tax-percentage" min="0" value="0.00">
                </td>
                <td class="item-line-total">0.00</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item">
                        {{ __('Remove') }}
                    </button>
                </td>
            `;
            return tr;
        };

        const bindRowEvents = (row) => {
            const inputs = row.querySelectorAll('.item-quantity, .item-unit-price, .item-discount, .item-tax-percentage');
            inputs.forEach((input) => {
                input.addEventListener('input', updateTotals);
            });

            const productSelect = row.querySelector('.item-product');
            productSelect.addEventListener('change', () => {
                const selectedId = Number(productSelect.value);
                const product = products.find((item) => item.id === selectedId);

                if (!product) {
                    return;
                }

                row.querySelector('.item-name-hidden').value = product.name;
                row.querySelector('.item-unit-price').value = Number(product.unit_price || 0).toFixed(2);

                updateTotals();
            });

            const removeButton = row.querySelector('.remove-item');
            removeButton.addEventListener('click', () => {
                row.remove();
                updateTotals();
            });
        };

        const updateTotals = () => {
            let subtotal = 0;
            let discountTotal = 0;
            let netTotal = 0;
            let taxTotal = 0;
            let grandTotal = 0;

            itemsBody.querySelectorAll('.item-row').forEach((row) => {
                const quantity = Number(row.querySelector('.item-quantity').value) || 0;
                const unitPrice = Number(row.querySelector('.item-unit-price').value) || 0;
                const enteredDiscount = Number(row.querySelector('.item-discount').value) || 0;
                const taxPercentage = Number(row.querySelector('.item-tax-percentage').value) || 0;

                const baseAmount = quantity * unitPrice;
                const discount = Math.min(enteredDiscount, baseAmount);
                const taxableAmount = Math.max(baseAmount - discount, 0);
                const taxAmount = taxableAmount * (taxPercentage / 100);
                const lineTotal = taxableAmount + taxAmount;

                subtotal += baseAmount;
                discountTotal += discount;
                netTotal += taxableAmount;
                taxTotal += taxAmount;
                grandTotal += lineTotal;

                row.querySelector('.item-line-total').textContent = formatAmount(lineTotal);
            });

            subtotalEl.textContent = formatAmount(subtotal);
            discountTotalEl.textContent = formatAmount(discountTotal);
            netTotalEl.textContent = formatAmount(netTotal);
            taxTotalEl.textContent = formatAmount(taxTotal);
            grandTotalEl.textContent = formatAmount(grandTotal);
        };

        window.addRow = () => {
            const newRow = createItemRow(itemIndex);
            itemsBody.appendChild(newRow);
            bindRowEvents(newRow);
            itemIndex += 1;
            updateTotals();
        };

        document.addEventListener('DOMContentLoaded', () => {
            if (!itemsBody.querySelector('.item-row')) {
                window.addRow();
            }
        });
    })();
</script>
@endpush

@endsection