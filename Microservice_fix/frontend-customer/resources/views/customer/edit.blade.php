@extends('layouts.main')


@section('content')
   <h2>Edit customer</h2>


   @if ($errors->any())
       <div style="color:red;">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif


   <form action="{{ route('customers.update', $customer['id']) }}" method="POST">
       @csrf
       @method('PUT')


       <label>Nama:</label>
       <input type="text" name="name" value="{{ old('name', $customer['name']) }}"><br>


       <label>email:</label>
       <input type="email" name="email" value="{{ old('email', $customer['email']) }}"><br>


       <label>address:</label>
       <input type="text" name="address" value="{{ old('address', $customer['address']) }}"><br>
<p></p>
       <button type="submit">Update</button>
   </form>
@endsection
