<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\Setting;
use App\Models\QuotationItem;
use App\Services\QuotationService;
use App\Http\Requests\StoreQuotationRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class QuotationController extends Controller
{
    public function __construct(
        private QuotationService $service
    ) {}

    public function index()
    {
        $quotations = Quotation::query()

            ->with([
                'customer:id,name',
                'items'
            ])

            ->latest()

            ->paginate(15);

        return view(
            'quotations.index',
            compact('quotations')
        );
    }

    public function create(): View
    {
        $customers = Customer::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        $products = collect();
        $productsForJs = [];
        $productSuggestions = collect();

        if (Schema::hasTable('products')) {
            $products = Product::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name', 'unit_price']);

            $productSuggestions = $products->pluck('name');

            $productsForJs = $products
                ->map(fn ($product) => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'unit_price' => (float) $product->unit_price,
                ])
                ->values()
                ->all();
        } elseif (Schema::hasTable('quotation_items')) {
            $productSuggestions = QuotationItem::query()
                ->select('item_name')
                ->distinct()
                ->orderBy('item_name')
                ->pluck('item_name');
        }

        return view(
            'quotations.create',
            compact('customers', 'products', 'productsForJs', 'productSuggestions')
        );
    }

    public function store(
        StoreQuotationRequest $request
    ) {

        $quotation =
            $this->service->create(
                $request->validated()
            );

        return redirect()
            ->route(
                'quotations.show',
                $quotation
            );
    }

    public function show(
        Quotation $quotation
    ) {

        $quotation->load([
            'customer',
            'items'
        ]);

        return view(
            'quotations.show',
            compact('quotation')
        );
    }

    public function preview(Quotation $quotation): View
    {
        $quotation->load([
            'customer',
            'items.product',
        ]);

        $company = [
            'name' => Setting::getValue('company_name', config('app.name')),
            'address' => Setting::getValue('company_address'),
            'email' => Setting::getValue('company_email'),
            'phone' => Setting::getValue('company_phone'),
        ];

        return view('quotations.preview', compact('quotation', 'company'));
    }

    public function download(Quotation $quotation): Response
    {
        $quotation->load([
            'customer',
            'items.product',
        ]);

        $company = [
            'name' => Setting::getValue('company_name', config('app.name')),
            'address' => Setting::getValue('company_address'),
            'email' => Setting::getValue('company_email'),
            'phone' => Setting::getValue('company_phone'),
        ];

        $pdf = Pdf::loadView('quotations.pdf', compact('quotation', 'company'));

        return $pdf->download('quotation-'.$quotation->id.'.pdf');
    }
}