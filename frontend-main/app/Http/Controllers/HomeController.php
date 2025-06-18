<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

class HomeController extends Controller
{
    protected $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        // ambil data produk & customer, masing‐masing sebagai Collection
        $products  = $this->api->allProduk();
        $customers = $this->api->allCustomer();

        return view('home', compact('products', 'customers'));
    }
}
