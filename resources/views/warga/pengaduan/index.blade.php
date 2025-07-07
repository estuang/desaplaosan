@extends('../layout/mainWarga')
@section('wargaContent')
    <main class="col-md-0 ms-sm-auto col-lg-10 px-md-4 mt-3">
        <div>
        </div>
        <div>
            <h2>Daftar Pengaduan Saya</h2>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Buat Pengaduan</button>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Foto</th>
                        <th>Foto Bukti Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaduans as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->judul }}</td>
                            <td>{{ $p->isi }}</td>
                            <td>
                                @if ($p->status == 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($p->status == 'diproses')
                                    <span class="badge bg-primary">Diproses</span>
                                @elseif($p->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($p->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">{{ $p->status }}</span>
                                @endif
                            </td>
                            <td>{{ $p->created_at->format('d-m-Y') }}</td>
                            <td>
                                @if ($p->foto)
                                    <img src="{{ asset('storage/' . $p->foto) }}" alt="Bukti" width="80">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($p->foto_bukti_admin)
                                    <img src="{{ asset('storage/' . $p->foto_bukti_admin) }}" alt="Bukti Admin" width="80">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Create -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Buat Pengaduan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('warga.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required
                                    maxlength="100">
                            </div>
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required
                                    maxlength="150">
                            </div>
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi Pengaduan</label>
                                <textarea class="form-control" id="isi" name="isi" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Bukti (opsional)</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
