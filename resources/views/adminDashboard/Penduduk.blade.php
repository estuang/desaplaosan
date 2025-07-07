@extends('../layout/mainAdmin')

@section('adminContent')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
    </div>
    <div class="card" style="width: 100%; height: 100%; background-color: white; padding: 20px">
        @if (session()->has('successUpdatedMasyarakat'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('successUpdatedMasyarakat') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('successCreatedMasyarakat'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('successCreatedMasyarakat') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('successDeletedMasyarakat'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('successDeletedMasyarakat') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('successDeletedAllData'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('successDeletedAllData') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <div>
            <div class="d-flex">

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cretaeDataMasyarakat" style="margin-right: 15px">Tambah Penduduk</button>
                <form action="/data-penduduk" method="GET" style="margin-left: 40%">

                    <input type="text" id="cari" name="cari" placeholder="Cari NIK/No KK/Nama">
                    <button type="submit" class="btn btn-success">Cari</button>
                </form>
            </div>


            <!-- Modal create-->
            <div class="modal fade" id="cretaeDataMasyarakat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cretaeDataMasyarakatLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="cretaeDataMasyarakatLabel">Tambah Penduduk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('data-penduduk/store')}}" method="post" id="formTambahPenduduk">
                            @csrf
                            <div class="modal-body">
                                <!-- Section Navigation -->
                                <ul class="nav nav-tabs mb-3" id="pendudukTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="akun-tab" data-bs-toggle="tab" data-bs-target="#akun" type="button" role="tab" aria-controls="akun" aria-selected="true">Akun</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false">Data Penduduk</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pendudukTabContent">
                                    <!-- Section Akun -->
                                    <div class="tab-pane fade show active" id="akun" role="tabpanel" aria-labelledby="akun-tab">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label"><b>Alamat</b></label>
                                            <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required value="{{ old('alamat') }}" autocomplete="off" placeholder="Input Alamat">
                                            @error('alamat')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="userName" class="form-label"><b>Username</b></label>
                                            <input type="text" name="userName" id="userName" class="form-control @error('userName') is-invalid @enderror" required value="{{ old('userName') }}" autocomplete="off" placeholder="Input Username">
                                            @error('userName')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label"><b>Password</b></label>
                                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Input Password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label"><b>Role</b></label>
                                            <select class="form-select" name="role" id="role">
                                                <option value="masyarakat" selected>Masyarakat</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" id="nextSection">Selanjutnya</button>
                                        </div>
                                    </div>
                                    <!-- Section Data Penduduk -->
                                    <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">
                                        <!-- Seluruh field data penduduk seperti sebelumnya -->
                                        <div class="mb-3">
                                            <label for="nik" class="form-label"><b>NIK</b></label>
                                            <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" required value="{{ old('nik') }}" autocomplete="off" placeholder="Input NIK Penduduk">
                                            @error('nik')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label"><b>Nama Penduduk</b></label>
                                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" required value="{{ old('nama') }}" autocomplete="off" placeholder="Input Nama Penduduk">
                                            @error('nama')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_kk" class="form-label"><b>No KK</b></label>
                                            <input type="text" name="no_kk" id="no_kk" class="form-control @error('no_kk') is-invalid @enderror" required value="{{ old('no_kk') }}" autocomplete="off" placeholder="Input Nomor KK Penduduk">
                                            @error('no_kk')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-sm-6">
                                                <label for="rt" class="form-label"><b>RT</b></label>
                                                <input type="text" name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror" required value="{{ old('rt') }}" autocomplete="off" placeholder="Input rt">
                                                @error('rt')
                                                <div class="invalid-feedback">
                                                    <p style="text-align: left">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="rw" class="form-label"><b>RW</b></label>
                                                <input type="text" name="rw" id="rw" class="form-control @error('rw') is-invalid @enderror" required value="{{ old('rw') }}" autocomplete="off" placeholder="Input rw">
                                                @error('rw')
                                                <div class="invalid-feedback">
                                                    <p style="text-align: left">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jk" class="form-label"><b>Jenis Kelamin</b></label>
                                            <select class="form-select" name="jk" id="jk">
                                                <option value="" selected>Silakan Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-sm-6">
                                                <label for="tempat_lahir" class="form-label"><b>Tempat lahir</b></label>
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" required value="{{ old('tempat_lahir') }}" autocomplete="off" placeholder="Input Tempat Lahir">
                                                @error('tempat_lahir')
                                                <div class="invalid-feedback">
                                                    <p style="text-align: left">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="tgl_lahir" class="form-label"><b>Tanggal Lahir</b></label>
                                                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" required value="{{ old('tgl_lahir') }}" autocomplete="off" placeholder="Input tgl Lahir">
                                                @error('tgl_lahir')
                                                <div class="invalid-feedback">
                                                    <p style="text-align: left">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="wn" class="form-label"><b>Warga Negara</b></label>
                                            <select class="form-select" name="wn" id="wn">
                                                <option value="" selected>Silakan Pilih Jenis Warga Negara</option>
                                                <option value="WNI">WNI</option>
                                                <option value="WNA">WNA</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kebangsaan" class="form-label"><b>Kebangsaan</b></label>
                                            <input type="text" name="kebangsaan" id="kebangsaan" class="form-control @error('kebangsaan') is-invalid @enderror" required value="{{ old('kebangsaan') }}" autocomplete="off" placeholder="Input Kebangsaan">
                                            @error('kebangsaan')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="agama" class="form-label"><b>Agama</b></label>
                                            <select class="form-select" name="agama" id="agama">
                                                <option value="" selected>Silakan Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Konghucu">Konghucu</option>
                                                <option value="Hindu">Hindu</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pekerjaan" class="form-label"><b>Pekerjaan</b></label>
                                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" required value="{{ old('pekerjaan') }}" autocomplete="off" placeholder="Input pekerjaan">
                                            @error('pekerjaan')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="pendidikan" class="form-label"><b>Pendidikan</b></label>
                                            <input type="text" name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" required value="{{ old('pendidikan') }}" autocomplete="off" placeholder="Input pendidikan">
                                            @error('pendidikan')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="sts_kawin" class="form-label"><b>Status Kawin</b></label>
                                            <select class="form-select" name="sts_kawin" id="sts_kawin">
                                                <option value="" selected>Silakan Pilih Status Kawin</option>
                                                <option value="Kawin">Kawin</option>
                                                <option value="Belum Kawin">Belum Kawin</option>
                                                <option value="Cerai Hidup">Cerai Hidup</option>
                                                <option value="Cerai Mati">Cerai Mati</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sts_penduduk" class="form-label"><b>Status Penduduk</b></label>
                                            <select class="form-select" name="sts_penduduk" id="sts_penduduk">
                                                <option value="" selected>Silakan Pilih Status Penduduk</option>
                                                <option value="Warga Baru Menunggu Verifikasi">Warga Baru Menunggu Verifikasi</option>
                                                <option value="Meninggal">Meninggal</option>
                                                <option value="Tinggal">Tinggal</option>
                                                <option value="Pindah Keluar">Pindah Keluar</option>
                                                <option value="Warga Pindah Menunggu Verifikasi">Warga Pindah Menunggu Verifikasi</option>
                                                <option value="Warga Meninggal Menunggu Verifikasi">Warga Meninggal Menunggu Verifikasi</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sts_dalam_kk" class="form-label"><b>Status Dalam KK</b></label>
                                            <select class="form-select" name="sts_dalam_kk" id="sts_dalam_kk">
                                                <option value="" selected>Silakan Pilih Status Dalam KK</option>
                                                <option value="Anak">Anak</option>
                                                <option value="Kepala_Keluarga">Kepala Keluarga</option>
                                                <option value="Suami">Suami</option>
                                                <option value="Istri">Istri</option>
                                                <option value="orang_lain">Orang Lain</option>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary" id="prevSection">Sebelumnya</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table" style="text-align: left; color: black">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>NoKK</th>
                        <th>Padukuhan</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Status</th>
                        <th style="text-align: center">Action</th>
                    </tr>
                    @foreach ($masyarakat as $index => $item)
                    <tr style="width: 100%">
                        <td style="vertical-align: middle; width: 5%; ">{{ $index + $masyarakat->firstItem() }}</td>
                        <td style="vertical-align: middle;  ">{!! substr($item->nik,0,4). str_repeat('*', 16)!!}</td>
                        <td style="vertical-align: middle;  ">{{ $item->nama }}</td>
                        <td style="vertical-align: middle;  ">{!! substr($item->no_kk,0,4). str_repeat('*', 16)!!}</td>
                        <td style="vertical-align: middle;  ">{{ $item->padukuhan }}</td>
                        <td style="vertical-align: middle;  ">{{ $item->rt }}</td>
                        <td style="vertical-align: middle;  ">{{ $item->rw }}</td>
                        <td style="vertical-align: middle;  ">{{ $item->jk }}</td>
                        <td style="vertical-align: middle;  ">{{ $item->tempat_lahir }}</td>
                        <td style="vertical-align: middle;  ">{{ $item->sts_penduduk }}</td>
                        <td style="text-align: center;  ">
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editDataMasyarakat{{ $item->nik }}">Edit</button>
                        </td>
                    </tr>

                    <!-- Modal delete-->
                    <div class="modal fade" id="staticBackdrop{{ $item->nik}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Data Penduduk</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda yakin untuk menghapus data <b>{{ $item->nama }}</b></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{route('data-penduduk', $item->nik) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Deleted</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal edit-->
                    <div class="modal fade" id="editDataMasyarakat{{ $item->nik }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataMasyarakatLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editDataMasyarakatLabel">Edit Data Penduduk</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('data-penduduk/update',$item->nik)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label for="nik" class="form-label"><b>NIK</b></label>

                                            <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" required value="{{ $item->nik }}" autocomplete="off" placeholder="Input NIK Penduduk">

                                            @error('nik')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label"><b>Nama Penduduk</b></label>

                                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" required value="{{ $item->nama }}" autocomplete="off" placeholder="Input Nama Penduduk">

                                            @error('nama')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="no_kk" class="form-label"><b>No KK</b></label>

                                            <input type="text" name="no_kk" id="no_kk" class="form-control @error('no_kk') is-invalid @enderror" required value="{{ $item->no_kk }}" autocomplete="off" placeholder="Input Nomor KK Penduduk">

                                            @error('no_kk')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-sm-6">
                                                <label for="rt" class="form-label"><b>RT</b></label>

                                                <input type="text" name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror" required value="{{ $item->rt }}" autocomplete="off" placeholder="Input rt">

                                                @error('rt')
                                                <div class="invalid-feedback">
                                                    <p style="text-align: left">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="rw" class="form-label"><b>RW</b></label>

                                                <input type="text" name="rw" id="rw" class="form-control @error('rw') is-invalid @enderror" required value="{{ $item->rw }}" autocomplete="off" placeholder="Input rw">

                                                @error('rw')
                                                <div class="invalid-feedback">
                                                    <p style="text-align: left">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="jk" class="form-label"><b>Jenis Kelamin</b></label>

                                            <select class="form-select" name="jk" id="jk">
                                                <option value="" selected>Silakan Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki" {{ $item->jk == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="Perempuan" {{ $item->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-sm-6">
                                                <label for="tempat_lahir" class="form-label"><b>Tempat lahir</b></label>

                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" required value="{{ $item->tempat_lahir }}" autocomplete="off" placeholder="Input Tempat Lahir">

                                                @error('tempat_lahir')
                                                <div class="invalid-feedback">
                                                    <p style="text-align: left">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="tgl_lahir" class="form-label"><b>Tanggal Lahir</b></label>

                                                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" required value="{{ $item->tgl_lahir }}" autocomplete="off" placeholder="Input tgl Lahir">

                                                @error('tgl_lahir')
                                                <div class="invalid-feedback">
                                                    <p style="text-align: left">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="wn" class="form-label"><b>Warga Negara</b></label>

                                            <select class="form-select" name="wn" id="wn">
                                                <option value="">Silakan Pilih Jenis Warga Negara</option>
                                                @if($item->wn==="WNA")
                                                <option name="wn" id="wn" value="WNI">WNI</option>
                                                <option name="wn" id="wn" value="WNA" selected>WNA</option>
                                                @elseif($item->wn==="WNI")
                                                <option name="wn" id="wn" value="WNI" selected>WNI</option>
                                                <option name="wn" id="wn" value="WNA">WNA</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="agama" class="form-label"><b>Agama</b></label>

                                            <input type="text" name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror" required value="{{ $item->agama }}" autocomplete="off" placeholder="Input agama">

                                            @error('agama')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pekerjaan" class="form-label"><b>Pekerjaan</b></label>

                                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" required value="{{ $item->pekerjaan }}" autocomplete="off" placeholder="Input pekerjaan">

                                            @error('pekerjaan')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pendidikan" class="form-label"><b>Pendidikan</b></label>

                                            <input type="text" name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" required value="{{ $item->pendidikan }}" autocomplete="off" placeholder="Input pendidikan">

                                            @error('pendidikan')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="sts_kawin" class="form-label"><b>Status Kawin</b></label>

                                            <select class="form-select" name="sts_kawin" id="sts_kawin">
                                                <option value="" {{ $item->sts_kawin == '' ? 'selected' : '' }}>Silakan Pilih Status Kawin</option>
                                                <option value="Kawin" {{ $item->sts_kawin == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                                <option value="Belum Kawin" {{ $item->sts_kawin == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                                <option value="Cerai Hidup" {{ $item->sts_kawin == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                                <option value="Cerai Mati" {{ $item->sts_kawin == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="sts_penduduk" class="form-label"><b>Status Penduduk</b></label>
                                            <select class="form-select" name="sts_penduduk" id="sts_penduduk">
                                                <option value="" {{ $item->sts_penduduk == '' ? 'selected' : '' }}>Silakan Pilih Status Penduduk</option>
                                                <option value="Warga Baru Menunggu Verifikasi" {{ $item->sts_penduduk == 'Warga Baru Menunggu Verifikasi' ? 'selected' : '' }}>Warga Baru Menunggu Verifikasi</option>
                                                <option value="Meninggal" {{ $item->sts_penduduk == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                                                <option value="Tinggal" {{ $item->sts_penduduk == 'Tinggal' ? 'selected' : '' }}>Tinggal</option>
                                                <option value="Pindah Keluar" {{ $item->sts_penduduk == 'Pindah Keluar' ? 'selected' : '' }}>Pindah Keluar</option>
                                                <option value="Warga Pindah Menunggu Verifikasi" {{ $item->sts_penduduk == 'Warga Pindah Menunggu Verifikasi' ? 'selected' : '' }}>Warga Pindah Menunggu Verifikasi</option>
                                                <option value="Warga Meninggal Menunggu Verifikasi" {{ $item->sts_penduduk == 'Warga Meninggal Menunggu Verifikasi' ? 'selected' : '' }}>Warga Meninggal Menunggu Verifikasi</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="sts_dalam_kk" class="form-label"><b>Status Dalam KK</b></label>

                                            <select class="form-select" name="sts_dalam_kk" id="sts_dalam_kk">
                                                <option value="" {{ $item->sts_dalam_kk == '' ? 'selected' : '' }}>Silakan Pilih Status Penduduk</option>
                                                <option value="Kepala Keluarga" {{ $item->sts_dalam_kk == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                                <option value="Istri" {{ $item->sts_dalam_kk == 'Istri' ? 'selected' : '' }}>Istri</option>
                                                <option value="Anak" {{ $item->sts_dalam_kk == 'Anak' ? 'selected' : '' }}>Anak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal tambah keluarga-->
                    <div class="modal fade" id="tambahKel{{ $item->nik }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahKelLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editDataMasyarakatLabel">Tambah Data Keluarga</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('data-penduduk/store',$item->nik)}}" method="post">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label for="nik" class="form-label"><b>NIK</b></label>

                                            <select class="form-select" name="nik" id="nik">
                                                <option name="nik" id="nik" value="" selected>Silakan Pilih NIK</option>
                                                @foreach($pendu as $penduduk)
                                                <option name="nik" id="nik" value="{{$penduduk->nik}}">{{$penduduk->nik}} | {{$penduduk->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="no_kk" class="form-label"><b>No KK</b></label>

                                            <input type="text" name="no_kk" id="no_kk" class="form-control @error('no_kk') is-invalid @enderror" required value="{{ $item->no_kk }}" autocomplete="off" placeholder="Input Nomor KK Penduduk">

                                            @error('no_kk')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="sts_keluarga" class="form-label"><b>Status Keluarga</b></label>

                                            <input type="text" name="sts_keluarga" id="sts_keluarga" class="form-control @error('sts_keluarga') is-invalid @enderror" required value="{{ $item->sts_keluarga }}" autocomplete="off" placeholder="Input Status Keluarga">

                                            @error('sts_keluarga')
                                            <div class="invalid-feedback">
                                                <p style="text-align: left">{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </table>
                <div class="d-flex justify-content-between mb-3">
                    {{ $masyarakat->links('layout.pagination') }}
                </div>
            </div>

        </div>
</main>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nextBtn = document.getElementById('nextSection');
        const prevBtn = document.getElementById('prevSection');
        const akunTab = document.getElementById('akun-tab');
        const dataTab = document.getElementById('data-tab');
        nextBtn.addEventListener('click', function() {
            dataTab.click();
        });
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                akunTab.click();
            });
        }
    });
</script>