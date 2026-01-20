@extends('layouts.app')

@section('content')
    {{-- Breadcrumb Navigation --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}"><i class="bi bi-people"></i> Pelanggan</a>
            </li>
            <li class="breadcrumb-item active">{{ $pelanggan->nama }}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                {{-- Card Header dengan ID Badge --}}
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-person-check"></i> Detail Pelanggan
                        </h5>
                        <span class="badge bg-primary text-white p-2">
                            <i class="bi bi-hashtag"></i> ID: {{ $pelanggan->id }}
                        </span>
                    </div>
                </div>

                {{-- Card Body dengan Data Display --}}
                <div class="card-body">
                    {{-- Nama Lengkap --}}
                    <div class="mb-4 pb-4 border-bottom">
                        <div class="d-flex align-items-start gap-3">
                            <div class="text-primary" style="font-size: 1.5rem;">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-1">
                                    <i class="bi bi-info-circle"></i> Nama Lengkap
                                </h6>
                                <p class="mb-0 fw-bold fs-5">{{ $pelanggan->nama }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Usia --}}
                    <div class="mb-4 pb-4 border-bottom">
                        <div class="d-flex align-items-start gap-3">
                            <div class="text-info" style="font-size: 1.5rem;">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-1">
                                    <i class="bi bi-info-circle"></i> Usia
                                </h6>
                                <p class="mb-0">
                                    <span class="badge bg-info">{{ $pelanggan->usia }} tahun</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-4 pb-4 border-bottom">
                        <div class="d-flex align-items-start gap-3">
                            <div class="text-warning" style="font-size: 1.5rem;">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-1">
                                    <i class="bi bi-info-circle"></i> Alamat
                                </h6>
                                <p class="mb-0 lh-lg">{{ $pelanggan->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Metadata Section --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-success" style="font-size: 1.5rem;">
                                    <i class="bi bi-calendar"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-1">
                                        <i class="bi bi-info-circle"></i> Terdaftar Pada
                                    </h6>
                                    <p class="mb-0">
                                        <small>{{ $pelanggan->created_at->format('d F Y') }}</small>
                                        <br>
                                        <small class="text-muted">{{ $pelanggan->created_at->format('H:i') }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-secondary" style="font-size: 1.5rem;">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-1">
                                        <i class="bi bi-info-circle"></i> Terakhir Diupdate
                                    </h6>
                                    <p class="mb-0">
                                        <small>
                                            <span
                                                class="badge bg-secondary">{{ $pelanggan->updated_at->diffForHumans() }}</span>
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Footer dengan Action Buttons --}}
                <div class="card-footer bg-white border-top py-3">
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning text-white">
                            <i class="bi bi-pencil"></i> Edit Data
                        </a>
                        <button type="button" class="btn btn-danger"
                            onclick="showDeleteConfirm({{ $pelanggan->id }}, '{{ $pelanggan->nama }}')">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                        <form id="deleteForm{{ $pelanggan->id }}"
                            action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal Script --}}
    <script>
        function showDeleteConfirm(id, nama) {
            const modalHTML = `
                <div class="modal fade" id="deleteModal${id}" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">
                                    <i class="bi bi-exclamation-circle"></i> Konfirmasi Hapus
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin <strong>menghapus</strong> pelanggan berikut?</p>
                                <div class="alert alert-warning mb-3">
                                    <i class="bi bi-person"></i> <strong>${nama}</strong>
                                </div>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-info-circle"></i>
                                    <small>Tindakan ini tidak dapat dibatalkan.</small>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x"></i> Batal
                                </button>
                                <button type="button" class="btn btn-danger" onclick="submitDelete(${id})">
                                    <i class="bi bi-trash"></i> Ya, Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = modalHTML;
            document.body.appendChild(tempDiv);

            const deleteModal = new bootstrap.Modal(document.getElementById(`deleteModal${id}`));
            deleteModal.show();

            document.getElementById(`deleteModal${id}`).addEventListener('hidden.bs.modal', function() {
                this.remove();
            });
        }

        function submitDelete(id) {
            document.getElementById(`deleteForm${id}`).submit();
        }
    </script>
@endsection
