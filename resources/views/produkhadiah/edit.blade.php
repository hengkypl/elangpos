@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Edit Produk Hadiah</div>

                <div class="card-body">
                    <form action="{{ route('hadiah.update', $produkhadiah->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="namabarang">Nama Barang</label>
                            <input type="text" name="namabarang" class="form-control" value="{{ $produkhadiah->namabarang }}">
                        </div>

                        <div class="form-group">
                            <label for="point">Point</label>
                            <input type="number" name="point" class="form-control" value="{{ $produkhadiah->point }}">
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control">{{ $produkhadiah->keterangan }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label"></label>
                            @if ($produkhadiah->foto)
                                <img src="{{ Storage::url($produkhadiah->foto) }}" alt="{{ $produkhadiah->namabarang }}" width="100">
                            @else
                                No Image
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
