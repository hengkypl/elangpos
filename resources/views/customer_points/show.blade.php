@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2>Jumlah Point Customer</h2>
        </div>
        <div class="card-body">
            <h5 class="card-title">Member ID: {{ $customer->memberid }}</h5>
            <h2 class="card-title">{{ $customer->nama }}</h2>
            <h5 class="card-title">Alamat : {{ $customer->alamat }}</h5>
            <h5 class="card-title">Kota : {{ $customer->alamat }}</h5>
            <h2 class="card-text"><strong>Total Points: {{ $totalPoints }} </strong> </h2>
            <a href="/customer-points" class="btn btn-secondary mt-3">Check Another Customer</a>
        </div>
    </div>
</div>
@endsection
