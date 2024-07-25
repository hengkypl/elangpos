@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h2>Penukaran Poin Customer</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('redeem.searchMember') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="memberid">Member ID:</label>
                <input type="text" name="memberid" id="memberid" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Cari</button>
        </form>

        @if (isset($customer))
            <div id="customerInfo">
                <div class="border mt-3 text-muted">
                    <div class="mx-auto" style="width: 200px">
                        <h6> Customer Detail :</h6>
                        <h4><span id="customerName">{{ $customer->nama }}</span></h4>
                        <h5>Sisa Poin: <span id="customerPoints">{{ $totalPoints }}</span></h5>
                    </div>
                </div>
            </div>

            <form id="redeemForm" action="{{ route('redeem.points') }}" method="POST">
                @csrf
                <input type="hidden" name="customerid" value="{{ $customer->id }}">
                <input type="hidden" name="total_points" value="{{ $totalPoints }}">

                <h4><small class="text-muted mt-5"> Hadiah yang dapat di pilih </small> </h4>
                <table class="table-light table-bordered table table-striped table-responsive-sm table table-sm">
                    <thead class= "thead-dark">
                        <tr>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Poin</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td style="width:20%"><img src="{{ Storage::url($product->foto) }}"
                                        alt="{{ $product->namabarang }}" width="200"></td>
                                <td style="width:50%">{{ $product->namabarang }}</td>
                                <td class="text-center" style="width:10%">{{ $product->point }}</td>
                                <td class="text-center" style="width:10%">
                                    <input type="number" id="quantity_{{ $product->id }}" name="quantities[]" class="form-control quantity" min="1" value="1"
                                        data-points="{{ $product->point }}" data-id="{{ $product->id }}">
                                </td>
                                <td class="text-center" style="width:10%">
                                    <input class=" form-check-input product-checkbox" type="checkbox"
                                        value="{{ $product->id }}" id="product_{{ $product->id }}" name="product_ids[]"
                                        data-points="{{ $product->point }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div>
                    {{ $products->appends(['customer' => $customer->id, 'totalPoints' => $totalPoints])->links() }}
                </div>

                <p>Total Poin Hadiah: <span id="totalProductPoints">0</span></p>
                <button type="submit" class="btn btn-primary">Tukar</button>
            </form>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalPoints = {{ $totalPoints ?? 0 }};
            let selectedPoints = 0;

            function updateTotalPoints() {
                selectedPoints = 0;
                document.querySelectorAll('.product-checkbox:checked').forEach(checkbox => {
                    const pointValue = parseInt(checkbox.dataset.points);
                    const quantity = parseInt(document.querySelector(
                        `.quantity[data-id="${checkbox.value}"]`).value);
                    selectedPoints += pointValue * quantity;
                });

                document.getElementById('totalProductPoints').innerText = selectedPoints;
            }

            document.querySelectorAll('.product-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateTotalPoints();
                    if (selectedPoints > totalPoints) {
                        this.checked = false;
                        alert('Total poin hadiah yang dipilih melebihi sisa poin customer.');
                        updateTotalPoints();
                    }
                });
            });

            document.querySelectorAll('.quantity').forEach(input => {
                input.addEventListener('input', function() {
                    updateTotalPoints();
                    const checkbox = document.querySelector(
                        `.product-checkbox[value="${this.dataset.id}"]`);
                    if (selectedPoints > totalPoints) {
                        alert('Total poin hadiah yang dipilih melebihi sisa poin customer.');
                        checkbox.checked = false;
                        updateTotalPoints();
                    }
                });
            });
        });
    </script>
@endsection
