@extends('layouts.app')

@section('content')
    {{-- Breadcrumb Navigation --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}"><i class="bi bi-people"></i> Pelanggan</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.show', $pelanggan->id) }}">{{ $pelanggan->nama }}</a>
            </li>
            <li class="breadcrumb-item active"><i class="bi bi-pencil"></i> Edit</li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="bi bi-pencil-square"></i> Edit Data Pelanggan
            </h5>
        </div>
        <div class="card-body">
            {{-- Action mengarah ke route update dengan ID pelanggan --}}
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" id="formPelanggan">
                @csrf
                @method('PUT')

                {{-- Nama Lengkap --}}
                <div class="mb-4">
                    <label for="nama" class="form-label fw-bold">
                        <i class="bi bi-person-circle text-primary"></i> Nama Lengkap
                    </label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                        id="nama" placeholder="Contoh: Budi Santoso" value="{{ old('nama', $pelanggan->nama) }}"
                        minlength="3" maxlength="255" required>
                    <small class="form-text text-muted d-block mt-2">
                        <i class="bi bi-info-circle"></i> Minimal 3 karakter, maksimal 255 karakter
                    </small>
                    @error('nama')
                        <div class="invalid-feedback d-block mt-2">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Usia --}}
                <div class="mb-4">
                    <label for="usia" class="form-label fw-bold">
                        <i class="bi bi-calendar-check text-primary"></i> Usia
                    </label>
                    <div class="input-group">
                        <input type="number" class="form-control @error('usia') is-invalid @enderror" name="usia"
                            id="usia" placeholder="Contoh: 25" value="{{ old('usia', $pelanggan->usia) }}"
                            min="1" max="150" required>
                        <span class="input-group-text bg-light">Tahun</span>
                    </div>
                    <small class="form-text text-muted d-block mt-2">
                        <i class="bi bi-info-circle"></i> Usia antara 1-150 tahun
                    </small>
                    @error('usia')
                        <div class="invalid-feedback d-block mt-2">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label for="alamat" class="form-label fw-bold">
                        <i class="bi bi-geo-alt text-primary"></i> Alamat
                    </label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                        placeholder="Masukkan alamat lengkap Anda..." rows="4" minlength="5" maxlength="1000" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    <small class="form-text text-muted d-block mt-2 d-flex justify-content-between">
                        <span><i class="bi bi-info-circle"></i> Minimal 5 karakter, maksimal 1000 karakter</span>
                        <span><strong id="charCount">{{ strlen(old('alamat', $pelanggan->alamat)) }}</strong>/1000
                            karakter</span>
                    </small>
                    @error('alamat')
                        <div class="invalid-feedback d-block mt-2">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex gap-2 mt-5 pt-3 border-top">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                    <a href="{{ route('pelanggan.show', $pelanggan->id) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- JavaScript untuk Character Counter & Submit Prevention --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alamatField = document.getElementById('alamat');
            const charCount = document.getElementById('charCount');
            const form = document.getElementById('formPelanggan');
            const submitBtn = document.getElementById('submitBtn');

            // Update character counter
            function updateCharCount() {
                charCount.textContent = alamatField.value.length;
            }

            alamatField.addEventListener('input', updateCharCount);

            // Prevent double submit
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';
            });
        });
    </script>
@endsection
