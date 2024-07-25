@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Produk </h1>
        <div class="mb-3">
            <label for="namabarang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="namabarang" value="{{ $produkhadiah->namabarang }}" disabled>
        </div>
        <div class="mb-3">
            <label for="point" class="form-label">Point</label>
            <input type="number" class="form-control" id="point" value="{{ $produkhadiah->point }}" disabled>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" disabled>{{ $produkhadiah->keterangan }}</textarea>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            @if ($produkhadiah->foto)
                <img src="{{ Storage::url($produkhadiah->foto) }}" alt="{{ $produkhadiah->namabarang }}" width="100">
            @else
                No Image
            @endif
        </div>
        <a href="{{ route('hadiah.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
