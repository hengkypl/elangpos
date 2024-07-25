@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Welcome to Laksana Elang</h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Daftar Hadiah </h5> </strong>
                        <p class="card-text">List daftar hadiah yang tersedia buat konsumen.</p>
                        <a href="/hadiah" class="btn btn-primary">Daftar Hadiah</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ $totalRecords }} Barang tidak terdaftar</h5></strong>
                        <p class="card-text">Barang yang tidak terdaftar yang di scan di kasir</p>
                        <a href="tidakterdaftar" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
