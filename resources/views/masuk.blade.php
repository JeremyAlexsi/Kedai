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
                    <span><i class="bi bi-exclamation-lg"></i></i></span>
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                class="mdi mdi-close"></i></span>
                    </button>
                    {{ session()->get('error') }}
                </div>
            @endif
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
                                    <h2>Barang Masuk</h2>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                                        <i class="fa fa-plus"></i> Tambah Barang
                                    </button>
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
                                                    <th>Tanggal Masuk</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach ($history_masuk as $d)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $d->nama_barang }}</td>
                                                        <td>{{ $d->jenis_barang }}</td>
                                                        <td>{{ $d->quantity }}</td>
                                                        <td>{{ $d->tanggal_masuk }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jenis Barang</th>
                                                    <th>Quantity</th>
                                                    <th>Tanggal Masuk</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- Modal Tambah Barang -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/tambah" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select id="disabledTextInput" name="nama_barang" class="form-control" required>
                            @foreach($barang_masuk as $d)
                            <option>{{ $d->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tambah</label>
                        <input type="text" class="form-control" name="tambahStock" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Barang Masuk">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="datetime-local" class="form-control" name="tanggalMasuk" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Barang Masuk">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!--**********************************
                Content body end
    ***********************************-->
@endsection
