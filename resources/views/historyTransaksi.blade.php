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
                        <h2>Transaksi</h2>
                    </div>
                </div>
            </div>
            <!-- row -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>History</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Quantity</th>
                                            <th>Total Belanja</th>
                                            <th>Bayar</th>
                                            <th>Kembalian</th>
                                            <th>Tanggal Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($transaksi as $t)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $t->quantity }}</td>
                                                <td>{{ $t->total }}</td>
                                                <td>{{ $t->bayar }}</td>
                                                <td>{{ $t->kembalian }}</td>
                                                <td>{{ $t->tanggal_transaksi }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Quantity</th>
                                            <th>Total Belanja</th>
                                            <th>Bayar</th>
                                            <th>Kembalian</th>
                                            <th>Tanggal Transaksi</th>
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
</div>
    <!--**********************************
                        Content body end
                    ***********************************-->
@endsection
