{{-- filepath: d:\web-desa-plaosan-ta-copy-Copy\resources\views\adminDashboard\surat-keterangan\index.blade.php --}}
@extends('../layout/mainAdmin')

@section('adminContent')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar Pengajuan Surat Keterangan</h1>
        </div>
        <div class="card" style="width: 100%; background-color: white; padding: 20px">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="text-align: left; color: black">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Warga</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surat as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->penduduk->nama }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>
                                    @if ($item->status_verifikasi == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($item->status_verifikasi == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Detail User -->
                                    @if ($item->user && $item->user->penduduk)
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detailUserModal{{ $item->id }}">
                                            Detail User
                                        </button>
                                    @endif
                                    <!-- Tombol Validasi -->
                                    @if ($item->status_verifikasi == 'pending')
                                        <a href="{{ route('admin.surat-keterangan.validasiForm', $item->id) }}"
                                            class="btn btn-sm btn-primary mb-1">
                                            Validasi
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Modal diletakkan di luar tabel --}}
            @foreach ($surat as $item)
                @if ($item->user && $item->user->penduduk)
                    <div class="modal fade" id="detailUserModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="detailUserModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailUserModalLabel{{ $item->id }}">
                                        Detail Data Penduduk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <td>{{ $item->user->penduduk->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tempat dan Tanggal Lahir</th>
                                            <td>{{ $item->user->penduduk->tempat_lahir ?? '-' }},
                                                {{ $item->user->penduduk->tanggal_lahir ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td>{{ $item->user->penduduk->nik }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>{{ $item->user->penduduk->jk ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan</th>
                                            <td>{{ $item->user->penduduk->pekerjaan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Perkawinan</th>
                                            <td>{{ $item->user->penduduk->sts_kawin ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat Lengkap</th>
                                            <td>{{ $item->user->alamat ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kewarganegaraan</th>
                                            <td>{{ $item->user->penduduk->kebangsaan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Agama</th>
                                            <td>{{ $item->user->penduduk->agama ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </main>
@endsection
