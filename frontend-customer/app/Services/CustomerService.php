<?php
namespace App\Services;


use Illuminate\Support\Facades\Http;


class CustomerService
{
   protected $baseUrl;


   public function __construct()
   {
       $this->baseUrl = env('CUSTOMER_SERVICE_URL') . '/api/customer';
   }


   public function getAll()
   {
       return Http::get($this->baseUrl)->json();
   }


   public function find($id)
   {
       return Http::get("{$this->baseUrl}/{$id}")->json();
   }


   public function create(array $data)
   {
       return Http::post($this->baseUrl, $data)->json();
   }


   public function update($id, array $data)
   {
       return Http::put("{$this->baseUrl}/{$id}", $data)->json();
   }


   public function delete($id)
   {
       return Http::delete("{$this->baseUrl}/{$id}")->json();
   }
}
