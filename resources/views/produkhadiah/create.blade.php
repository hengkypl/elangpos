@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Create Produk Hadiah</h1>
        <form action="{{ route('hadiah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="namabarang" class="form-label">Nama Barang</label>
                <input type="text" name="namabarang" class="form-control" id="namabarang" required>
            </div>
            <div class="mb-3">
                <label for="point" class="form-label">Point</label>
                <input type="number" name="point" class="form-control" id="point" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" id="foto">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
