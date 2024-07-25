<!-- resources/views/pointmember/search.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Search Customer by Member ID</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('pointmember.showPoints') }}" method="GET">
        @csrf
        <div class="form-group">
            <label for="memberid">Member ID:</label>
            <input type="text" name="memberid" id="memberid" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
@endsection
