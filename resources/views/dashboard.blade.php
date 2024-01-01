@extends('layouts.sidebar')

@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
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
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card text-white bg-success">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content ">
                                    <div class="stat-text text-white">Income Hari ini</div>
                                    <div class="stat-digit text-white"> Rp {{ number_format($hari_ini->pendapatan_hari_ini, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card text-white bg-info">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text text-white">Income Bulan ini</div>
                                    <div class="stat-digit text-white"> Rp {{ number_format($bulan_ini->pendapatan_bulan_ini, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card text-white bg-success">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text text-white">Transaksi Hari ini</div>
                                    <div class="stat-digit text-white"><i class="bi bi-box-seam-fill"></i> {{ $hari_ini->transaksi_hari_ini }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card text-white bg-info">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text text-white">Transaksi Bulan ini</div>
                                    <div class="stat-digit text-white"><i class="bi bi-box-seam-fill"></i> {{ $bulan_ini->transaksi_bulan_ini }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pendapatan Tiap Bulan</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-with-area" class="ct-chart ct-golden-section"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Transaksi Tiap Bulan</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart2-with-area" class="ct-chart ct-golden-section"></div>
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
