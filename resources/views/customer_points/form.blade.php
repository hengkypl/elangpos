@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Check Poin Customer</h2>
    <form action="{{ route('customer.points.show') }}" method="POST">
        @csrf
        <div class="mt-3 mb-3 form-group">
            <label for="memberid">Nomor HP:</label>
            <input type="text" name="memberid" id="memberid" class="form-control" required placeholder="Masukkan Nomor HP Member">
        </div>
        <button type="submit" class="btn btn-primary">Check Points</button>
    </form>
</div>
@endsection
