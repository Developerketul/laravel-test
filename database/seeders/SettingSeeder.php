<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'company_name' => 'Acme Invoicing Solutions Pvt Ltd',
            'company_address' => '402, Silver Arc Complex, SG Highway, Ahmedabad, Gujarat 380015, India',
            'company_email' => 'accounts@acmeinvoicing.example',
            'company_phone' => '+91 79 4000 1234',
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
    }
}