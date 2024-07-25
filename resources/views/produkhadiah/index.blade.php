@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>
            <span class="d-block p-2 bg-info text-white">Daftar Hadiah</span>
        </h2>
        <!-- Form Filter dan Tombol Add -->
        <div class="d-flex justify-content-between mb-4">
            <form action="{{ route('hadiah.index') }}" method="GET" class="form-inline mr-10 w-100">
                <div class="input-group col-md-8">
                    <input type="text" name="search" class="form-control w-75" placeholder="Cari nama barang" value="{{ request()->get('search') }}">
                    <div class="input-group-append col ml-3">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>                      
                </div>
            </form>
            @auth
                <a href="{{ route('hadiah.create') }}" class="btn btn-success">Add</a>
            @endauth
        </div>

        <div class="row">
            @foreach ($produkhadiahs as $produkhadiah)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                    <div class="card shadow-sm w-100">
                        <img src="{{ Storage::url($produkhadiah->foto) }}" class="card-img-top"
                            alt="{{ $produkhadiah->namabarang }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column" style="display: flex; flex-direction: column; height: 100%;">
                            <h5 class="card-title">{{ $produkhadiah->namabarang }}</h5>
                            <p class="card-text">{{ $produkhadiah->keterangan ?? 'Tidak ada keterangan' }}</p>
                            <p class="card-text text-info font-weight-bold font-italic">Points: {{ $produkhadiah->point }}
                            </p>
                            @auth
                                <div class="card-footer"
                                    style="display: flex; justify-content: space-between; align-items: center; margin-top:auto;">
                                    <a href="{{ route('hadiah.edit', $produkhadiah->id) }}"
                                        class="btn btn-primary btn-block">Edit</a>
                                    <form action="{{ route('hadiah.destroy', $produkhadiah->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $produkhadiahs->links() }}
        </div>

    </div>
@endsection
