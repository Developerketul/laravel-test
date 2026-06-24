<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function editCompany(): View
    {
        $settings = [
            'company_name' => Setting::getValue('company_name', config('app.name')),
            'company_address' => Setting::getValue('company_address'),
            'company_email' => Setting::getValue('company_email'),
            'company_phone' => Setting::getValue('company_phone'),
        ];

        return view('settings.company', compact('settings'));
    }

    public function updateCompany(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['nullable', 'string', 'max:1000'],
            'company_email' => ['nullable', 'email', 'max:255'],
            'company_phone' => ['nullable', 'string', 'max:50'],
        ]);

        foreach ($data as $key => $value) {
            Setting::setValue($key, $value);
        }

        return back()->with('success', __('Company settings updated successfully.'));
    }
}
