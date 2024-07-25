@extends('layout')

@section('content')
    <h1>Tambah Data Tidak Terdaftar</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tidakterdaftar.store') }}" method="POST">
        @csrf
        <div>
            <label for="kassa">Kassa:</label>
            <input type="text" id="kassa" name="kassa" value="{{ old('kassa') }}">
        </div>
        <div>
            <label for="operator">Operator:</label>
            <input type="text" id="operator" name="operator" value="{{ old('operator') }}">
        </div>
        <div>
            <label for="kodebarang">Kode Barang:</label>
            <input type="text" id="kodebarang" name="kodebarang" value="{{ old('kodebarang') }}">
        </div>
        <button type="submit">Tambah</button>
    </form>
@endsection
