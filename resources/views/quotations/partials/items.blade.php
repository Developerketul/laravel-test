<div class="card">

    <div class="card-header">

        {{ __('Items') }}

        <button type="button" class="btn btn-primary float-end" onclick="addRow()">

            {{ __('Add Item') }}

        </button>

    </div>

    <div class="card-body">

        <table class="table table-bordered" id="items-table">

            <thead>

                <tr>

                    <th>{{ __('Product') }}</th>

                    <th>{{ __('Qty') }}</th>

                    <th>{{ __('Unit Price') }}</th>

                    <th>{{ __('Discount') }}</th>

                    <th>{{ __('Tax %') }}</th>

                    <th>{{ __('Total') }}</th>

                    <th></th>

                </tr>

            </thead>

            <tbody id="items-body">

            </tbody>

        </table>

    </div>

</div>