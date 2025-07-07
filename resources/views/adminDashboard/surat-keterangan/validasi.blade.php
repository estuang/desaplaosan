{{-- filepath: d:\web-desa-plaosan-ta-copy-Copy\resources\views\adminDashboard\surat-keterangan\validasi.blade.php --}}
@extends('../layout/mainAdmin')

@section('adminContent')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Validasi Surat Keterangan</h1>
    </div>
    <div class="card" style="width: 100%; background-color: white; padding: 20px">
        <div class="card-body">
            <form action="{{ route('admin.surat-keterangan.validasi', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><b>Kategori</b></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $surat->kategori }}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><b>Keterangan Warga</b></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="2" readonly>{{ $surat->keterangan_warga }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><b>Status Validasi</b></label>
                    <div class="col-sm-9">
                        <select class="form-select" name="status_verifikasi" id="status_verifikasi" required onchange="toggleUploadFile()">
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row" id="file_upload_group" style="display: none;">
                    <label class="col-sm-3 col-form-label"><b>Upload File Surat (PDF/JPG/PNG)</b></label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="file_upload" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label"><b>Keterangan Admin</b></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="keterangan" rows="2" placeholder="Tulis keterangan jika perlu..."></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Validasi</button>
                </div>
            </form>
        </div>
    </div>
</main>
<script>
function toggleUploadFile() {
    var status = document.getElementById('status_verifikasi').value;
    var fileGroup = document.getElementById('file_upload_group');
    if (status === 'diterima') {
        fileGroup.style.display = 'flex';
    } else {
        fileGroup.style.display = 'none';
    }
}
</script>
@endsection