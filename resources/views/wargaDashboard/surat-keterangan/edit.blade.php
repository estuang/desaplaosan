{{-- filepath: d:\web-desa-plaosan-ta-copy-Copy\resources\views\wargaDashboard\surat-keterangan\edit.blade.php --}}
@extends('layout.mainWarga')

@section('wargaContent')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ $title ?? 'Edit Pengajuan Surat Keterangan' }}</h1>
        </div>
        <div class="card" style="width: 100%; background-color: white; padding: 20px">
            <div class="card-body">
                <form action="{{ route('warga.surat-keterangan.update', $surat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="kategori" class="form-label"><b>Kategori Surat Keterangan</b></label>
                        <select class="form-select @error('kategori') is-invalid @enderror" name="kategori" id="kategori"
                            required>
                            <option value="" disabled>Pilih Kategori Surat</option>
                            <option value="Surat Keterangan Domisili"
                                {{ $surat->kategori == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan
                                Domisili</option>
                            <option value="Surat Keterangan Tidak Mampu"
                                {{ $surat->kategori == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan
                                Tidak Mampu</option>
                            <!--<option value="Surat Pengantar" {{ $surat->kategori == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>-->
                            <option value="Surat Keterangan Usaha"
                                {{ $surat->kategori == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha
                            </option>
                            <!--<option value="Surat Keterangan Kelahiran" {{ $surat->kategori == 'Surat Keterangan Kelahiran' ? 'selected' : '' }}>Surat Keterangan Kelahiran</option>-->
                            <!--<option value="Surat Keterangan Kematian" {{ $surat->kategori == 'Surat Keterangan Kematian' ? 'selected' : '' }}>Surat Keterangan Kematian</option>-->
                            <option value="Surat Izin Acara" {{ $surat->kategori == 'Surat Izin Acara' ? 'selected' : '' }}>
                                Surat Izin Acara</option>
                            <!--<option value="Surat Keterangan Belum Menikah" {{ $surat->kategori == 'Surat Keterangan Belum Menikah' ? 'selected' : '' }}>Surat Keterangan Belum Menikah</option>-->
                            <!--<option value="Surat Keterangan Pindah" {{ $surat->kategori == 'Surat Keterangan Pindah' ? 'selected' : '' }}>Surat Keterangan Pindah</option>-->
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label"><b>Keterangan Tambahan</b> <small
                                class="text-muted">(Opsional)</small></label>
                        <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                            rows="3" placeholder="Tulis keterangan tambahan jika diperlukan...">{{ old('keterangan', $surat->keterangan_warga ?? $surat->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label"><b>No. HP Aktif</b></label>
                        <input type="text" name="no_hp" id="no_hp"
                            class="form-control @error('no_hp') is-invalid @enderror"
                            value="{{ old('no_hp', $surat->no_hp) }}" maxlength="15" required pattern="^[0-9+\- ]{10,15}$"
                            placeholder="08xxxxxxxxxx">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Surat</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
