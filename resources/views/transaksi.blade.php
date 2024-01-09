@extends('layouts.sidebar')

@section('content')
    <!--**********************************
                                                Content body start
                                            ***********************************-->

    <div class="content-body">
        <div class="container-fluid">
            @if (session()->has('success'))
                <div class="alert alert-success solid alert-right-icon alert-dismissible fade show">
                    <span><i class="mdi mdi-check"></i></span>
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                class="mdi mdi-close"></i></span>
                    </button>
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger solid alert-right-icon alert-dismissible fade show">
                <span><i class="bi bi-exclamation-lg"></i></span>
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
                {{ session()->get('error') }}
            </div>
            @endif
            @if (session()->has('keranjang'))
            <div class="alert alert-success solid alert-right-icon alert-dismissible fade show">
                <span><i class="bi bi-cart"></i></span>
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
                {{ session()->get('keranjang') }}
            </div>
            @endif
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h2>Transaksi</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h2 class="card-label">Transaksi</h2>
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#transaksiModal">
                                Pilih Barang
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-primary">
                                <table id="example2" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Harga</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i= 1 @endphp
                                        @foreach ($keranjang as $k)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $k->nama_barang }}</td>
                                                <td>{{ $k->jenis_barang }}</td>
                                                <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                                                <td>{{ $k->quantity }}</td>
                                                <td>Rp {{ number_format($k->subtotal, 0, ',', '.') }}</td>
                                                <td>
                                                    <a href="/transaksi/hapus/{{ $k->id }}" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Harga</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h2>Transaksi</h2>
                        </div>
                        <div class="card-body">
                            <form action="/transaksi/simpan" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Total Belanja</label>
                                    @php
                                        $total = 0;
                                        $totalQ = 0;
                                        foreach ($keranjang as $k) {
                                            $total += $k->subtotal;
                                            $totalQ += $k->quantity;
                                        }
                                    @endphp
                                    <input type="hidden" class="form-control" name="quantity" id="totalBelanja"
                                        value="{{ $totalQ }}" readonly>
                                    <input type="text" class="form-control" name="total" id="total"
                                        value="{{ $total }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Bayar</label>
                                    <input type="text" class="form-control" id="bayar" name="bayar" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kembalian</label>
                                    <input type="text" class="form-control" id="kembalian" name="kembalian"
                                        placeholder="" readonly>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Transaksi Barang -->
    <div class="modal fade bd-example-modal-lg" id="transaksiModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="/transaksi/keranjang" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive text-primary">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Harga</th>
                                        <th>Stock</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i= 1 @endphp
                                    @foreach ($barang as $d)
                                        @if ($d->quantity > 0)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td><input type="hidden" name="nama_barang{{ $i }}"
                                                        value="{{ $d->nama_barang }}" readonly>{{ $d->nama_barang }}</td>
                                                <td><input type="hidden" name="jenis_barang{{ $i }}"
                                                        value="{{ $d->jenis_barang }}" readonly>{{ $d->jenis_barang }}
                                                </td>
                                                <td><input type="hidden" name="harga{{ $i }}"
                                                        value="{{ $d->harga }}" readonly>Rp
                                                    {{ number_format($d->harga, 0, ',', '.') }}</td>
                                                <td><input type="hidden" name="quantity{{ $i }}"
                                                        value="{{ $d->quantity }}" readonly>{{ $d->quantity }}</td>
                                                <td><input class="form-control" type="number"
                                                        name="jumlah{{ $i++ }}" min="1"></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Harga</th>
                                        <th>Stock</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnMasukkan">Masukkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--**********************************
                                                Content body end
                                ***********************************-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Attach an input event listener to the #bayar input
            $('#bayar').on('input', function() {
                // Get the values of total and bayar
                var total = parseFloat('{{ $total }}');
                var bayar = parseFloat($(this).val()) || 0;

                // Calculate the kembalian
                var kembalian = bayar - total;

                // Display the kembalian in the #kembalian input
                $('#kembalian').val(kembalian.toFixed(2));
            });

            // Optional: If you want to reset the kembalian when the form is submitted
            $('#transaksiForm').on('submit', function() {
                $('#kembalian').val('');
            });
        });
    </script>
@endsection
