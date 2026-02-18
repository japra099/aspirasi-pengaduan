<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .card { border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: none; }
        .card-header-admin {
            background: linear-gradient(135deg, #e94560 0%, #0f3460 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px 25px;
        }
        .stat-card { border-radius: 12px; border: none; color: white; padding: 20px; text-align: center; }
        .stat-pending  { background: linear-gradient(135deg, #f6d365, #fda085); color: #333 !important; }
        .stat-diproses { background: linear-gradient(135deg, #a1c4fd, #c2e9fb); color: #333 !important; }
        .stat-selesai  { background: linear-gradient(135deg, #43e97b, #38f9d7); color: #333 !important; }
        .stat-total    { background: linear-gradient(135deg, #667eea, #764ba2); }
        .badge-pending  { background-color: #ffc107 !important; color: #333; }
        .badge-diproses { background-color: #0dcaf0 !important; color: #333; }
        .badge-selesai  { background-color: #198754 !important; }
        .table th { font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .btn-kelola { background: linear-gradient(135deg, #667eea, #764ba2); border: none; color: white; }
        .btn-kelola:hover { color: white; opacity: 0.9; }
        .foto-thumb { width: 55px; height: 55px; object-fit: cover; border-radius: 8px; cursor: pointer; transition: transform 0.2s; }
        .foto-thumb:hover { transform: scale(1.15); }
        .filter-bar { background: #f8f9fa; border-radius: 10px; padding: 15px; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container-fluid">

    {{-- Header --}}
    <div class="card mb-4">
        <div class="card-header-admin d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3 class="mb-0">🛠️ Panel Admin — Kelola Pengaduan Sarana</h3>
                <small class="opacity-75"></small>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                @auth
                    <span class="badge bg-light text-dark px-3 py-2">👤 {{ Auth::user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">🚪 Logout</button>
                    </form>
                @endauth
                <a href="{{ route('aspirasi.daftar') }}" class="btn btn-light btn-sm">← Daftar Pengaduan</a>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card stat-total shadow-sm">
                <div class="fs-2 fw-bold">{{ $aspirasis->count() }}</div>
                <div class="small fw-semibold">Total Pengaduan</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card stat-pending shadow-sm">
                <div class="fs-2 fw-bold">{{ $aspirasis->where('status','Pending')->count() }}</div>
                <div class="small fw-semibold">⏳ Pending</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card stat-diproses shadow-sm">
                <div class="fs-2 fw-bold">{{ $aspirasis->where('status','Diproses')->count() }}</div>
                <div class="small fw-semibold">🔧 Diproses</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card stat-selesai shadow-sm">
                <div class="fs-2 fw-bold">{{ $aspirasis->where('status','Selesai')->count() }}</div>
                <div class="small fw-semibold">✅ Selesai</div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card">
        <div class="card-body p-4">

            {{-- Filter --}}
            <div class="filter-bar d-flex flex-wrap gap-2 align-items-center">
                <span class="fw-bold me-1">🔍 Filter:</span>
                @php $currentStatus = request('status'); @endphp
                <a href="{{ route('feedback.index') }}"                               class="btn btn-sm {{ !$currentStatus ? 'btn-dark' : 'btn-outline-dark' }}">Semua</a>
                <a href="{{ route('feedback.index', ['status'=>'Pending']) }}"         class="btn btn-sm {{ $currentStatus=='Pending'  ? 'btn-warning' : 'btn-outline-warning' }}">Pending</a>
                <a href="{{ route('feedback.index', ['status'=>'Diproses']) }}"        class="btn btn-sm {{ $currentStatus=='Diproses' ? 'btn-info'    : 'btn-outline-info' }}">Diproses</a>
                <a href="{{ route('feedback.index', ['status'=>'Selesai']) }}"         class="btn btn-sm {{ $currentStatus=='Selesai'  ? 'btn-success' : 'btn-outline-success' }}">Selesai</a>
            </div>

            @php
                $data = $currentStatus ? $aspirasis->where('status', $currentStatus)->values() : $aspirasis;
            @endphp

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Detail Pengaduan</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Umpan Balik</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                            <tr>
                                <td class="text-muted small">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $item->nama_siswa }}</td>
                                <td><span class="badge bg-secondary">{{ $item->kelas }}</span></td>
                                <td><span class="badge bg-primary bg-opacity-75">{{ $item->kategori_pengaduan }}</span></td>
                                <td>
                                    <span title="{{ $item->detail_pengaduan }}" style="cursor:help">
                                        {{ Str::limit($item->detail_pengaduan, 55) }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->foto_sarana)
                                        <img src="{{ asset('storage/'.$item->foto_sarana) }}"
                                             class="foto-thumb"
                                             alt="Foto"
                                             data-bs-toggle="modal"
                                             data-bs-target="#modalFoto{{ $item->id }}">
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ strtolower($item->status) }} px-2 py-1">
                                        @if($item->status=='Pending') ⏳ @elseif($item->status=='Diproses') 🔧 @else ✅ @endif
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="small">
                                    @if($item->umpan_balik)
                                        <span class="text-success">{{ Str::limit($item->umpan_balik, 40) }}</span>
                                    @else
                                        <span class="text-muted fst-italic">Belum ada</span>
                                    @endif
                                </td>
                                <td class="small text-muted">{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <button class="btn btn-kelola btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                        ✏️ Kelola
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-muted">
                                    📭 Tidak ada pengaduan ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-muted small mt-2">Menampilkan {{ $data->count() }} dari {{ $aspirasis->count() }} pengaduan</div>
        </div>
    </div>
</div>

{{-- Modals --}}
@foreach($aspirasis as $item)

    {{-- Modal Kelola --}}
    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header" style="background: linear-gradient(135deg,#e94560,#0f3460); color:white;">
                    <h5 class="modal-title">✏️ Kelola Pengaduan — {{ $item->nama_siswa }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    {{-- Info read-only --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Nama Siswa</div>
                            <div class="fw-semibold">{{ $item->nama_siswa }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Kelas</div>
                            <div class="fw-semibold">{{ $item->kelas }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Kategori</div>
                            <div class="fw-semibold">{{ $item->kategori_pengaduan }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Tanggal Masuk</div>
                            <div class="fw-semibold">{{ $item->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small mb-1">Detail Pengaduan</div>
                            <div class="p-3 bg-light rounded">{{ $item->detail_pengaduan }}</div>
                        </div>
                        @if($item->foto_sarana)
                            <div class="col-12">
                                <div class="text-muted small mb-1">Foto Sarana</div>
                                <img src="{{ asset('storage/'.$item->foto_sarana) }}" class="img-fluid rounded shadow-sm" style="max-height:220px;">
                            </div>
                        @endif
                    </div>

                    <hr>

                    {{-- Form update --}}
                    <form action="{{ route('feedback.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Pengaduan</label>
                            <select name="status" class="form-select" required>
                                <option value="Pending"  {{ $item->status=='Pending'  ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="Diproses" {{ $item->status=='Diproses' ? 'selected' : '' }}>🔧 Diproses</option>
                                <option value="Selesai"  {{ $item->status=='Selesai'  ? 'selected' : '' }}>✅ Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Umpan Balik Admin</label>
                            <textarea name="umpan_balik" class="form-control" rows="4"
                                placeholder="Tulis tanggapan atau tindakan yang telah dilakukan...">{{ $item->umpan_balik }}</textarea>
                        </div>
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success px-4">💾 Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Foto --}}
    @if($item->foto_sarana)
        <div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 bg-transparent">
                    <div class="modal-body text-center p-2">
                        <button type="button" class="btn btn-light mb-2" data-bs-dismiss="modal">✕ Tutup</button>
                        <br>
                        <img src="{{ asset('storage/'.$item->foto_sarana) }}" class="img-fluid rounded shadow" alt="Foto Sarana">
                        <p class="text-white mt-2 small">{{ $item->nama_siswa }} — {{ $item->kategori_pengaduan }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
