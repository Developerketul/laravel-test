<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember(

            'dashboard.stats',

            now()->addMinutes(15),

            function () {

                return [

                    'customers' =>
                        Customer::count(),

                    'quotations' =>
                        Quotation::count(),

                    'revenue' =>
                        Quotation::sum(
                            'grand_total'
                        )
                ];
            }
        );

        return view(
            'dashboard.index',
            compact('stats')
        );
    }
}