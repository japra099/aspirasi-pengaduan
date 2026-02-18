<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .badge-pending { background-color: #ffc107; }
        .badge-diproses { background-color: #0dcaf0; }
        .badge-selesai { background-color: #198754; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">📋 Daftar Aspirasi Pengaduan</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <a href="{{ route('aspirasi.form') }}" class="btn btn-primary mb-3">
                    ➕ Tambah Aspirasi Baru
                </a>
                <a href="{{ route('admin.login') }}" class="btn btn-success mb-3">
                    🔧 Admin - Kelola Feedback
                </a>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Kategori</th>
                                <th>Detail</th>
                                <th>Status</th>
                                <th>Umpan Balik</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasis as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_siswa }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->kategori_pengaduan }}</td>
                                    <td>{{ Str::limit($item->detail_pengaduan, 50) }}</td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($item->status) }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>{{ $item->umpan_balik ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('aspirasi.destroy', $item->id) }}" method="POST" 
                                              onsubmit="return confirm('Yakin hapus aspirasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada aspirasi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>