@extends('layouts.main')

@section('content')
<h2>Form Tambah Pengguna</h2>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('produks.store') }}" method="POST" >
    @csrf

    <label>Nama:</label>
    <input type="text" name="nama" value="{{ old('nama') }}"><br>

    <label>deskripsi:</label>
    <input type="text" name="deskripsi" value="{{ old('deskripsi') }}">
    <label>harga:</label>
    <input type="number" name="harga" value="{{ old('harga') }}">
   
  <br></br>
    <button type="submit">Simpan</button>
</form>
@endsection
