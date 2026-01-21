<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        /* ==================== Global Styles ==================== */
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
        }

        /* ==================== Breadcrumb Styles ==================== */
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            border-radius: 0.375rem;
        }

        .breadcrumb-item a {
            color: #0d6efd;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .breadcrumb-item a:hover {
            color: #0c63e4;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        /* ==================== Form Styles ==================== */
        .form-label {
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            color: #212529;
        }

        .form-label i {
            margin-right: 0.5rem;
        }

        .form-control,
        .form-select {
            border-color: #dee2e6;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .form-text {
            font-size: 0.85rem;
        }

        .form-text i {
            margin-right: 0.3rem;
        }

        .invalid-feedback {
            font-size: 0.85rem;
            display: none;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        /* ==================== Textarea Styles ==================== */
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* ==================== Input Group Styles ==================== */
        .input-group-text {
            border-color: #dee2e6;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* ==================== Button Styles ==================== */
        .btn {
            white-space: nowrap;
            flex-shrink: 0;
            font-weight: 500;
            transition: all 0.2s ease;
            border-radius: 0.375rem;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        .btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: #0c63e4;
            border-color: #0c63e4;
        }

        /* ==================== Card Styles ==================== */
        .card {
            border-radius: 0.5rem;
            transition: box-shadow 0.2s ease;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom-color: #dee2e6;
            padding: 1.25rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top-color: #dee2e6;
            padding: 1rem 1.5rem;
        }

        /* ==================== Badge Styles ==================== */
        .badge {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
        }

        .badge i {
            margin-right: 0.25rem;
        }

        /* ==================== Search Form Styles ==================== */
        .input-group {
            flex-wrap: nowrap;
        }

        .search-form {
            flex-wrap: nowrap;
        }

        .search-form-controls {
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        /* ==================== Pagination Styles ==================== */
        .pagination {
            margin: 0;
            gap: 0.25rem;
        }

        .pagination .page-link {
            border: 1px solid #dee2e6;
            color: #0d6efd;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }

        .pagination .page-link:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
            font-weight: 600;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            cursor: not-allowed;
            background-color: #f8f9fa;
        }

        /* ==================== Table Styles ==================== */
        tbody tr {
            transition: background-color 0.15s ease-in-out;
        }

        tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }

        /* ==================== Responsive Styles ==================== */
        @media (max-width: 768px) {
            .card-header {
                padding: 1rem 0.75rem !important;
            }

            .card-header .d-flex {
                flex-direction: column;
                align-items: stretch !important;
            }

            .card-header h5 {
                width: 100%;
                margin-bottom: 1rem;
            }

            .card-header .badge {
                align-self: flex-start;
            }

            .input-group {
                width: 100%;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .form-label {
                font-size: 0.9rem;
            }

            .breadcrumb {
                font-size: 0.9rem;
            }
        }
    </style>
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
