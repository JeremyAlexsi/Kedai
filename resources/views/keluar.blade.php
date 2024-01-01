@extends('layouts.sidebar')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h2>Barang</h2>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Barang Keluar</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Quantity</th>
                                                <th>Harga</th>
                                                <th>Tanggal Keluar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            @foreach ($barang_keluar as $d)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $d->nama_barang }}</td>
                                                    <td>{{ $d->jenis_barang }}</td>
                                                    <td>{{ $d->quantity }}</td>
                                                    <td>{{ $d->harga }}</td>
                                                    <td>{{ $d->tanggal_keluar }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Quantity</th>
                                                <th>Harga</th>
                                                <th>Tanggal Keluar</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
