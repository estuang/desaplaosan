@extends('../layout/mainAdmin')

@section('adminContent')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <div class="col-md-3 mb-5">
        <h3><a href="" class="text-black">DASHBOARD</a></h3>
    </div>
    <div class="row">
        @if (session()->has('loginSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('loginSuccess') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <style>
            .mainMenu:hover {
                background-color: gainsboro
            }
        </style>
        <div class="col-md-3 mb-4">
            <div class="col-md-3 mb-4">
                <div class="card d-inline-flex mainMenu" style="width: 16rem; padding: 12px;  border-left: 5px solid indigo">
                    <a href="{{ route('data-penduduk') }}" style="text-decoration: none; color: black">
                        <div class="d-flex">
                            <div style="width: 12rem">
                                <h6 style="color: indigo">Jumlah Penduduk</h6>
                                <h4>{{ $jumlahMasyarakat }} Penduduk</h4>
                            </div>
                            <div style="width: 4rem; ">
                                <h1><span style="color: black; vertical-align: middle" class="bi bi-people"></span></h1>
                            </div>
                        </div>
                        <div class="card-footer border bg-transparent" style="width: 100%">View Details</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card d-inline-flex mainMenu" style="width: 16rem; padding: 12px;  border-left: 5px solid #1746a2">
                <a href="{{ route('admin.surat-keterangan.index') }}" style="text-decoration: none; color: black">
                    <div class="d-flex">
                        <div style="width: 12rem">
                            <h6 style="color: #1746a2">Jumlah Pengajuan Surat</h6>
                            <h5>{{ $jumlahS }} Surat Keterangan</h5>
                        </div>
                        <div style="width: 4rem; ">
                            <h1><span style="color: black; vertical-align: middle" class="bi bi-file-earmark-text"></span></h1>
                        </div>
                    </div>
                    <div class="card-footer border bg-transparent" style="width: 100%">View Details</div>
                </a>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card d-inline-flex mainMenu" style="width: 16rem; padding: 12px;  border-left: 5px solid #f0ad4e">
                <a href="{{ route('admin.pengaduan.index') }}" style="text-decoration: none; color: black">
                    <div class="d-flex">
                        <div style="width: 12rem">
                            <h6 style="color: #f0ad4e">Jumlah Pengaduan</h6>
                            <h5>{{ $jumlahPengaduan }} Pengaduan</h5>
                        </div>
                        <div style="width: 4rem; ">
                            <h1><span style="color: black; vertical-align: middle" class="bi bi-file-earmark-plus"></span></h1>
                        </div>
                    </div>
                    <div class="card-footer border bg-transparent" style="width: 100%">View Details</div>
                </a>
            </div>

    </div>
          

</main>
@endsection