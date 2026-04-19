@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kirim Aspirasi Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori Aspirasi</label>
                            <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi Kejadian</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" 
                                   value="{{ old('lokasi') }}" placeholder="Contoh: Kantin, Lab RPL, Parkiran" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Detail Aspirasi</label>
                            <textarea name="keterangan" id="keterangan" rows="5" class="form-control @error('keterangan') is-invalid @enderror" 
                                      placeholder="Ceritakan detail aspirasi atau keluhan Anda..." required>{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Bukti (Opsional)</label>
                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Format: JPG, JPEG, PNG. Maksimal ukuran 2MB.</div>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('aspirasi.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4">Kirim Aspirasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection