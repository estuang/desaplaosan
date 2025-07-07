{{-- filepath: d:\web-desa-plaosan-ta-copy-Copy\resources\views\wargaDashboard\surat-keterangan\index.blade.php --}}
@extends('../layout/mainWarga')

@section('wargaContent')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ $title ?? 'Daftar Pengajuan Surat Keterangan' }}</h1>
        </div>
        <div class="card" style="width: 100%; height: 100%; background-color: white; padding: 20px">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex mb-3">
                <a href="{{ route('warga.surat-keterangan.create') }}" class="btn btn-primary"
                    style="margin-right: 15px">Ajukan Surat Baru</a>
            </div>
            @if (session('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('fail') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="text-align: left; color: black">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Keterangan Warga</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Download File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surat as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->keterangan_warga }}</td>
                                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    @if ($item->status_verifikasi == 'diterima')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($item->status_verifikasi == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status_verifikasi == 'diterima' && $item->file_upload)
                                        <a href="{{ asset('storage/surat_keterangan/' . $item->file_upload) }}"
                                            class="btn btn-sm btn-success" target="_blank">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status_verifikasi == 'pending')
                                        <a href="{{ route('warga.surat-keterangan.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning mb-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    @endif
                                    <form action="{{ route('warga.surat-keterangan.destroy', $item->id) }}" method="POST"
                                        style="display:inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada pengajuan surat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
