@extends('layouts.main')


@section('content')
<h2>Form Tambah Customer</h2>


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


<form action="{{ route('customers.store') }}" method="POST" >
   @csrf


   <label>Nama:</label>
   <input type="text" name="name" value="{{ old('name') }}"><br>


   <label>email:</label>
   <input type="email" name="email" value="{{ old('email') }}">
   <label>address:</label>
   <input type="text" name="address" value="{{ old('address') }}">
 
 <br></br>
   <button type="submit">Simpan</button>
</form>
@endsection
