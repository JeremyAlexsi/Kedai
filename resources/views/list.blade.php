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
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
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
                            <div class="card-title">
                                <h2 class="card-label">List Barang</h2>
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Input Barang
                            </button>
                        </div>



                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Quantity</th>
                                            <th>Harga</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barang as $d)
                                            <tr>
                                                <td>{{ $d->nama_barang }}</td>
                                                <td>{{ $d->jenis_barang }}</td>
                                                <td>{{ $d->quantity }}</td>
                                                <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                                                <td><img class="img-thumbnail"
                                                        src="{{ Storage::url('public/barang/' . $d->foto) }}"
                                                        style="width:150px" alt="img-thumbnail"></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#updateModal{{ $d->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteModal{{ $d->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#tambahModal{{ $d->id }}">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#kurangModal{{ $d->id }}">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Quantity</th>
                                            <th>Harga</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
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


    <!-- Modal Input Barang -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/list/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Input Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="disabledTextInput"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama Barang" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Barang</label>
                            <select id="disabledTextInput" name="jenis_barang" class="form-control" required>
                                <option selected>Pilih Jenis</option>
                                <option>Rokok</option>
                                <option>Sabun</option>
                                <option>Shampoo</option>
                                <option>Susu</option>
                                <option>Kopi</option>
                                <option>Gula</option>
                                <option>Mie</option>
                                <option>Es Krim</option>
                                <option>Soda</option>
                                <option>Teh</option>
                                <option>Permen</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Jumlah Barang" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="harga" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Harga Barang" required>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto" required>
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Update Barang -->
    @foreach ($barang as $d)
        <div class="modal fade" id="updateModal{{ $d->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="/list/update/{{ $d->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="quantity" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $d->quantity }}">
                            <input type="hidden" class="form-control" name="id" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $d->id }}">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" id="disabledTextInput"
                                    aria-describedby="emailHelp" placeholder="Masukkan Nama Barang"
                                    value="{{ $d->nama_barang }}">
                            </div>
                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <select id="disabledTextInput" name="jenis_barang" class="form-control">
                                    <option selected>{{ $d->jenis_barang }}</option>
                                    <option>Minuman</option>
                                    <option>Makanan</option>
                                    <option>Rokok</option>
                                    <option>Kebutuhan Harian</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" class="form-control" name="harga" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Masukkan Harga Barang"
                                    value="{{ $d->harga }}">
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="foto"
                                            value="{{ $d->foto }}">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                                <img class="img-thumbnail" src="{{ Storage::url('public/barang/' . $d->foto) }}"
                                    style="width:150px" alt="img-thumbnail">
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
    @endforeach
    <!-- Modal Delete Barang -->
    @foreach ($barang as $d)
        <div class="modal fade" id="deleteModal{{ $d->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="/list/hapus/{{ $d->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="id" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $d->id }}">
                            <h4 class="text-danger">Apakah anda yakin ingin menghapus {{ $d->nama_barang }} ?</h4>
                            <img class="img-thumbnail" src="{{ Storage::url('public/barang/' . $d->foto) }}"
                                style="width:150px" alt="img-thumbnail">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal Tambah Barang -->
    @foreach ($barang as $d)
        <div class="modal fade" id="tambahModal{{ $d->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="/list/tambah/{{ $d->id }}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" name="nama_barang" class="form-control" id="disabledTextInput"
                                    aria-describedby="emailHelp" placeholder="Masukkan Nama Barang"
                                    value="{{ $d->nama_barang }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <select id="disabledTextInput" name="jenis_barang" class="form-control"
                                    @readonly(true)>
                                    <option selected>{{ $d->jenis_barang }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tambah</label>
                                <input type="text" class="form-control" name="tambahStock" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Masukkan Tambahan Barang">
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" class="form-control" name="harga" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Masukkan Harga Barang"
                                    value="{{ $d->harga }}" readonly>
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
    @endforeach
    <!-- Modal Kurang Barang -->
    @foreach ($barang as $d)
        <div class="modal fade" id="kurangModal{{ $d->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="/list/kurang/{{ $d->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kurang Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" id="disabledTextInput"
                                    aria-describedby="emailHelp" placeholder="Masukkan Nama Barang"
                                    value="{{ $d->nama_barang }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <select id="disabledTextInput" name="jenis_barang" class="form-control"
                                    @readonly(true)>
                                    <option selected>{{ $d->jenis_barang }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kurang</label>
                                <input type="text" class="form-control" name="kurangStock" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Masukkan Barang Keluar">
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" class="form-control" name="harga" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Masukkan Harga Barang"
                                    value="{{ $d->harga }}" readonly>
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
    @endforeach
    <!--**********************************
                            Content body end
                        ***********************************-->
@endsection
