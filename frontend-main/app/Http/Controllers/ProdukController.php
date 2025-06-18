<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class ProdukController extends Controller
{
    protected $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        $produks = $this->api->allProduk();
        return view('produks.index', compact('produks'));
    }

    public function create()
    {
        return view('produks.create');
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'nama'      => 'required|string',
            'deskripsi' => 'required|string',
            'harga'     => 'required|numeric',
        ]);
        $this->api->createProduk($payload);

        return redirect()->route('produks.index')
                         ->with('success_products', 'Produk berhasil dibuat.');
    }

    public function edit($id)
    {
        $produk = $this->api->getProduk($id);
        return view('produks.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'nama'      => 'required|string',
            'deskripsi' => 'required|string',
            'harga'     => 'required|numeric',
        ]);
        $this->api->updateProduk($id, $payload);

        return redirect()->route('produks.index')
                         ->with('success_products', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->api->deleteProduk($id);
        return redirect()->route('produks.index')
                         ->with('success_products', 'Produk berhasil dihapus.');
    }
}
