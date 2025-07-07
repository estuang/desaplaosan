<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('../all/allCss')
    <link href="/css/signin.css" rel="stylesheet">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous" />
    <style>
        #section2 {
            display: none;
        }
    </style>
</head>

<body class="text-center">
    @include('../all/allScript')

    <main class="form-signin w-100 m-auto">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-error alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form id="registerForm" action="/register" method="POST">
            @csrf
            <div id="section1">
                <div class="d-flex justify-content-center px-2"><img src="{{asset('sides.png')}}" id="foto" alt="Logo" height="120px" /></div>
                <h1 class="h3 mb-3 fw-normal"><b>Buat Akun</b></h1>
                <p class="text-muted" style="font-size: 12px; margin-top: -8px;">Masukan Data Akun</p>
                <div class="form-group">
                    <input style="height: 55px" type="text" class="form-control" id="nik" name="nik" placeholder="NIK" autocomplete="off" required>
                    @error('nik')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input style="height: 55px" type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" autocomplete="off" required>
                    @error('name')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input style="height: 55px" type="text" class="form-control" id="userName" name="userName" placeholder="Username" autocomplete="off" required>
                    @error('userName')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input style="height: 55px" type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" autocomplete="off" required>
                    @error('alamat')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div>
                    <script>
                        function password_show_hide() {
                            var x = document.getElementById("password");
                            var show_eye = document.getElementById("show_eye");
                            var hide_eye = document.getElementById("hide_eye");
                            hide_eye.classList.remove("d-none");
                            if (x.type === "password") {
                                x.type = "text";
                                show_eye.style.display = "none";
                                hide_eye.style.display = "block";
                            } else {
                                x.type = "password";
                                show_eye.style.display = "block";
                                hide_eye.style.display = "none";
                            }
                        }
                    </script>
                    <div class="input-group mb-3">
                        <input style="height: 55px" name="password" type="password" class="input form-control" id="password" placeholder="password" required="true" aria-label="password" aria-describedby="basic-addon1" autocomplete="off" required />

                        <div class="input-group-append" style="height: 55px">
                            <span class="input-group-text" onclick="password_show_hide();">
                                <i class="fas fa-eye" id="show_eye"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="syarat" name="syarat" required>
                    <label class="form-check-label" for="exampleCheck1">Saya telah membaca, memahami dan menyetujui syarat dan ketentuan pengguna layanan website ini</label>
                    @error('syarat')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>

                <button type="button" class="w-100 btn btn-lg btn-success" id="nextSection"><b>Lanjutkan</b></button>

                <p>
                    Click <a href="{{ route('login') }}">disini</a> jika anda sudah punya akun.
                </p>
                <p class="mt-4">
                    Kembali ke <a href="{{ url('/welcome') }}" class="text-yellow-500 hover:text-yellow-700">Halaman Awal</a>.
                </p>
            </div>
            <div id="section2">
                <h1 class="h3 mb-3 fw-normal"><b>Data Lengkap Penduduk</b></h1>
                <div class="form-group">
                    <input style="height: 55px" type="text" class="form-control" id="no_kk" name="no_kk" placeholder="Nomor KK" autocomplete="off" required>
                    @error('no_kk')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="number" step="1" class="form-control" id="rt" name="rt" placeholder="RT" required>
                        @error('rt')
                        <div class="invalid-feedback">
                            <p style="text-align: left">{{ $message }}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="number" step="1" class="form-control" id="rw" name="rw" placeholder="RW" required>
                        @error('rw')
                        <div class="invalid-feedback">
                            <p style="text-align: left">{{ $message }}</p>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <select class="form-select" id="jk" name="jk" required>
                        <option value="">Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    @error('jk')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                    @error('tempat_lahir')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" required>
                    @error('tgl_lahir')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-select" id="wn" name="wn" required>
                        <option value="">Warga Negara</option>
                        <option value="WNI">WNI</option>
                        <option value="WNA">WNA</option>
                    </select>
                    @error('wn')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="kebangsaan" name="kebangsaan" placeholder="Kebangsaan" required>
                    @error('kebangsaan')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-select" id="agama" name="agama" required>
                        <option value="">Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Hindu">Hindu</option>
                    </select>
                    @error('agama')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" required>
                    @error('pekerjaan')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" placeholder="Pendidikan" required>
                    @error('pendidikan')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-select" id="sts_kawin" name="sts_kawin" required>
                        <option value="">Status Perkawinan</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                    @error('sts_kawin')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-select" id="sts_penduduk" name="sts_penduduk" required>
                        <option value="">Status Penduduk</option>
                        <option value="Warga Baru Menunggu Verifikasi">Warga Baru Menunggu Verifikasi</option>
                        <option value="Meninggal">Meninggal</option>
                        <option value="Tinggal">Tinggal</option>
                        <option value="Pindah Keluar">Pindah Keluar</option>
                        <option value="Warga Pindah Menunggu Verifikasi">Warga Pindah Menunggu Verifikasi</option>
                        <option value="Warga Meninggal Menunggu Verifikasi">Warga Meninggal Menunggu Verifikasi</option>
                    </select>
                    @error('sts_penduduk')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-select" id="sts_dalam_kk" name="sts_dalam_kk" required>
                        <option value="">Status Dalam KK</option>
                        <option value="Anak">Anak</option>
                        <option value="Kepala_Keluarga">Kepala Keluarga</option>
                        <option value="Suami">Suami</option>
                        <option value="Istri">Istri</option>
                        <option value="orang_lain">Orang Lain</option>
                    </select>
                    @error('sts_dalam_kk')
                    <div class="invalid-feedback">
                        <p style="text-align: left">{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" id="backSection">Kembali</button>
                    <button class="btn btn-success" type="submit"><b>Register</b></button>
                </div>
            </div>
        </form>
        <script>
            document.getElementById('nextSection').onclick = function(e) {
                e.preventDefault();
                var requiredFields = ['nik','name','userName','alamat','password','syarat'];
                var valid = true;
                requiredFields.forEach(function(id) {
                    var el = document.getElementById(id);
                    if (el && !el.value && el.type !== 'checkbox') valid = false;
                    if (el && el.type === 'checkbox' && !el.checked) valid = false;
                });
                if(valid) {
                    document.getElementById('section1').style.display = 'none';
                    document.getElementById('section2').style.display = 'block';
                } else {
                    alert('Mohon isi semua data akun dan setujui syarat.');
                }
            };
            document.getElementById('backSection').onclick = function(e) {
                e.preventDefault();
                document.getElementById('section2').style.display = 'none';
                document.getElementById('section1').style.display = 'block';
            };
        </script>
    </main>
</body>

</html>