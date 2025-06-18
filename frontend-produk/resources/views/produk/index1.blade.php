<h2>Daftar Produk</h2>
<a href="/produk/create">Tambah Produk</a>
<ul>
@foreach($produk as $item)
    <li>
        {{ $item['nama'] }} - Rp {{ number_format($item['harga']) }}
        <a href="/produk/{{ $item['id'] }}/edit">Edit</a>
        <form action="/produk/{{ $item['id'] }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </li>
@endforeach
</ul>
