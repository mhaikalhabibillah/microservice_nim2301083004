@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard Produk & Customer</h1>

    <div class="row">
        {{-- Tabel Produk --}}
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Produk</h5>
                    <a href="{{ route('produks.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $p)
                            <tr>
                                <td>{{ $p['nama'] }}</td>
                                <td>Rp {{ number_format($p['harga'],0,',','.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">Belum ada produk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Tabel Customer --}}
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Customer</h5>
                    <a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $c)
                            <tr>
                                <td>{{ $c['name'] }}</td>
                                <td>{{ $c['email'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">Belum ada customer.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
