<?php 
namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProdukController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $produks = $this->productService->getAll();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $this->productService->create($request->only('nama', 'deskripsi', 'harga'));
        return redirect('/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = $this->productService->find($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $this->productService->update($id, $request->only('nama', 'deskripsi', 'harga'));
        return redirect('/produk')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect('/produk')->with('success', 'Produk berhasil dihapus');
    }
}
