<!-- resources/views/pointmember/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Customer Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $customer->nama }}</h5>
            <p class="card-text">Member ID: {{ $customer->memberid }}</p>
            <p class="card-text">Total Points: {{ $totalPoints }}</p>
        </div>
    </div>

    <h2>Redeem Reward</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('pointmember.store') }}" method="POST">
        @csrf
        <input type="hidden" name="customerid" value="{{ $customer->id }}">
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jumlah_pengambilan">Jumlah Pengambilan Point:</label>
            <input type="number" name="jumlah_pengambilan" id="jumlah_pengambilan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Redeem</button>
    </form>
</div>
@endsection
