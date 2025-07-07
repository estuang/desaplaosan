@extends('./layout/mainAdmin')
@section('adminContent')
    <main class="col-md-0 ms-sm-auto col-lg-10 px-md-4 mt-3">
        <div>
        </div>
        <div>
            <h2>Daftar Semua Pengaduan</h2>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
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
                        <th>Aksi</th>
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
                            <td>{{ $p->created_at ? $p->created_at->format('d-m-Y') : '-' }}</td>
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
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $p->id }}">Ubah Status</button>
                            </td>
                        </tr>
                        <!-- Modal Edit Status -->
                        <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $p->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $p->id }}">Ubah Status
                                            Pengaduan
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.pengaduan.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" name="status" id="status" required>
                                                    <option value="menunggu"
                                                        {{ $p->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                    <option value="diproses"
                                                        {{ $p->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                    <option value="disetujui"
                                                        {{ $p->status == 'disetujui' ? 'selected' : '' }}>Disetujui
                                                    </option>
                                                    <option value="ditolak"
                                                        {{ $p->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                            <label for="foto_bukti_admin" class    ="form-label">Foto Bukti Admin (Opsional)</label>
                                                <input type="file" name="foto_bukti_admin" class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
