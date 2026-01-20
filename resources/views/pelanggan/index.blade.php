@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                <h5 class="mb-0 fw-bold text-primary">
                    <i class="bi bi-people-fill"></i> Data Pelanggan
                </h5>

                <div class="d-flex gap-2 align-items-center search-form-controls">
                    {{-- Form Pencarian --}}
                    <form action="{{ route('pelanggan.index') }}" method="GET"
                        class="d-flex gap-2 align-items-center search-form">
                        <div class="input-group input-group-sm" style="min-width: 200px;">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama/alamat..."
                                value="{{ request('search') }}" aria-label="Pencarian">
                            <button type="submit" class="btn btn-secondary" title="Cari pelanggan">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        @if (request('search'))
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </form>

                    {{-- Tombol Tambah --}}
                    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="8%">No</th>
                            <th scope="col" width="25%">Nama</th>
                            <th scope="col" width="12%">Usia</th>
                            <th scope="col" width="25%">Alamat</th>
                            <th scope="col" width="30%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggan as $p)
                            <tr>
                                <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $p->nama }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $p->usia }} tahun</span>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 280px;"
                                        title="{{ $p->alamat }}">
                                        {{ $p->alamat }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Aksi">
                                        {{-- Tombol Detail --}}
                                        <a href="{{ route('pelanggan.show', $p->id) }}" class="btn btn-info text-white"
                                            title="Lihat detail pelanggan" data-bs-toggle="tooltip">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-warning text-white"
                                            title="Edit data pelanggan" data-bs-toggle="tooltip">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        {{-- Tombol Hapus --}}
                                        <button type="button" class="btn btn-danger" title="Hapus pelanggan"
                                            data-bs-toggle="tooltip"
                                            onclick="showDeleteConfirm({{ $p->id }}, '{{ $p->nama }}')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </div>

                                    {{-- Form Hapus (Hidden) --}}
                                    <form id="deleteForm{{ $p->id }}"
                                        action="{{ route('pelanggan.destroy', $p->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                        <p class="mt-3 mb-0">Belum ada data pelanggan.</p>
                                        <small>Mulai dengan <a href="{{ route('pelanggan.create') }}">menambah pelanggan
                                                baru</a></small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <small class="text-muted">
                    Menampilkan
                    <strong>{{ $pelanggan->count() }}</strong> dari
                    <strong>{{ $pelanggan->total() }}</strong> data
                </small>
                <div>
                    {{-- withQueryString() memastikan parameter search tetap terbawa ke halaman berikutnya --}}
                    {{ $pelanggan->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Show delete confirmation modal
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
                                    <strong>${nama}</strong>
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

        // Submit delete form
        function submitDelete(id) {
            document.getElementById(`deleteForm${id}`).submit();
        }
    </script>
@endsection
