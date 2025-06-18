@extends('layouts.main')

@section('content')
    <h2>Edit produk</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produks.update', $produk['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama:</label>
        <input type="text" name="nama" value="{{ old('nama', $produk['nama']) }}"><br>

        <label>deskripsi:</label>
        <input type="text" name="deskripsi" value="{{ old('deskripsi', $produk['deskripsi']) }}"><br>

        <label>harga:</label>
        <input type="number" name="harga" value="{{ old('harga', $produk['harga']) }}"><br>
<p></p>
        <button type="submit">Update</button>
    </form>
@endsection
