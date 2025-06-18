<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\CustomerService;


class CustomerController extends Controller
{
   protected $customerService;


   public function __construct(CustomerService $customerService)
   {
       $this->customerService = $customerService;
   }


   public function index()
   {
       $customers = $this->customerService->getAll();
       return view('customer.index', compact('customers'));
   }


   public function create()
   {
       return view('customer.create');
   }


   public function store(Request $request)
   {
       $this->customerService->create($request->only('name', 'email', 'address'));
       return redirect('/customer')->with('success', 'Customer berhasil ditambahkan');
   }


   public function edit($id)
   {
       $customer = $this->customerService->find($id);
       return view('customer.edit', compact('customer'));
   }


   public function update(Request $request, $id)
   {
       $this->customerService->update($id, $request->only('name', 'email', 'address'));
       return redirect('/customer')->with('success', 'Customer berhasil diupdate');
   }


   public function destroy($id)
   {
       $this->customerService->delete($id);
       return redirect('/customer')->with('success', 'Customer berhasil dihapus');
   }
}




