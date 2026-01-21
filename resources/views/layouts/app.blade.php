<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('pelanggan.index') }}">
                <i class="bi bi-people"></i> Manajemen Pelanggan
            </a>
        </div>
    </nav>

    <div class="container">
        {{-- Flash Message Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Flash Message Error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <strong>Validation Errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tempat Konten Halaman Akan Disuntikkan --}}
        @yield('content')
    </div>

    <footer class="bg-light border-top mt-5 py-4">
        <div class="container text-center text-muted">
            <small>&copy; 2026 Manajemen Pelanggan. All rights reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Confirm delete dengan better UX
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'deleteModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title"><i class="bi bi-exclamation-circle"></i> Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin <strong>menghapus</strong> pelanggan ini?</p>
                            <p class="text-muted mb-0"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" onclick="this.closest('.modal').previousElementSibling.submit()">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            form.insertAdjacentElement('beforebegin', modal);
            const deleteModal = new bootstrap.Modal(modal);
            deleteModal.show();
            modal.addEventListener('hidden.bs.modal', () => modal.remove());
        }
    </script>
</body>

</html>
