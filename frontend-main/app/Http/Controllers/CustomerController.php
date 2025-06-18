<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class CustomerController extends Controller
{
    protected $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        $customers = $this->api->allCustomer();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'name'      => 'required|string',
            'email' => 'required|string',
            'address'     => 'required|string',
        ]);
        $this->api->createCustomer($payload);

        return redirect()->route('customers.index')
                         ->with('success_products', 'Customer berhasil dibuat.');
    }

    public function edit($id)
    {
        $customer = $this->api->getCustomer($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'name'      => 'required|string',
            'email' => 'required|string',
            'address'     => 'required|string',
        ]);
        $this->api->updateCustomer($id, $payload);

        return redirect()->route('customers.index')
                         ->with('success_products', 'Customer berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->api->deleteCustomer($id);
        return redirect()->route('customers.index')
                         ->with('success_products', 'Customer berhasil dihapus.');
    }
}
