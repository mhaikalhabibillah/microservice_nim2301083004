<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = config('services.gateway.url');
    }

    // PRODUK
    public function allProduk()
    {
        return collect(Http::get("{$this->gateway}/api/produk")->json());
    }

    public function getProduk($id)
    {
        return Http::get("{$this->gateway}/api/produk/{$id}")->json();
    }

    public function createProduk(array $data)
    {
        return Http::post("{$this->gateway}/api/produk", $data);
    }

    public function updateProduk($id, array $data)
    {
        return Http::put("{$this->gateway}/api/produk/{$id}", $data);
    }

    public function deleteProduk($id)
    {
        return Http::delete("{$this->gateway}/api/produk/{$id}");
    }

    // CUSTOMER
    public function allCustomer()
    {
        return collect(Http::get("{$this->gateway}/api/customer")->json());
    }

    public function getCustomer($id)
    {
        return Http::get("{$this->gateway}/api/customer/{$id}")->json();
    }

    public function createCustomer(array $data)
    {
        return Http::post("{$this->gateway}/api/customer", $data);
    }

    public function updateCustomer($id, array $data)
    {
        return Http::put("{$this->gateway}/api/customer/{$id}", $data);
    }

    public function deleteCustomer($id)
    {
        return Http::delete("{$this->gateway}/api/customer/{$id}");
    }
}
