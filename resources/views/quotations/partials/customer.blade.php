<div class="mb-3">

    <label class="form-label">

        {{ __('Project / Job') }}

    </label>

    <input
        type="text"
        name="project_name"
        class="form-control"
        value="{{ old('project_name') }}"
        placeholder="{{ __('Project name or reference') }}"
    >

</div>

<div class="mb-3">

    <label class="form-label">

        {{ __('Customer') }}

    </label>

    <select id="customer_id" name="customer_id" class="form-control" required>
        <option value="">{{ __('Select a customer') }}</option>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                {{ $customer->name }}
            </option>
        @endforeach
    </select>

</div>