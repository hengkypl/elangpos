<!-- resources/views/tidakterdaftar/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">{{ __('Daftar Tidak Terdaftar') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kassa</th>
                                    <th>Operator</th>
                                    <th>Kode Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->kassa }}</td>
                                        <td>{{ $item->operator }}</td>
                                        <td>{{ $item->kodebarang }}</td>
                                        @auth
                                            <td>
                                                <form action="{{ route('tidakterdaftar.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        @endauth
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
