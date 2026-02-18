<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Aspirasi Siswa</title>
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
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">📝 Form Aspirasi Pengaduan Sarana Sekolah</h3>
                        <small></small>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Siswa</label>
                                <input type="text" name="nama_siswa" class="form-control @error('nama_siswa') is-invalid @enderror" 
                                       value="{{ old('nama_siswa') }}" placeholder="Masukkan nama lengkap" required>
                                @error('nama_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Kelas</label>
                                <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" 
                                       value="{{ old('kelas') }}" placeholder="Contoh: XII PPLG2" required>
                                @error('kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Kategori Pengaduan</label>
                                <select name="kategori_pengaduan" class="form-select @error('kategori_pengaduan') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Ruang Kelas" {{ old('kategori_pengaduan') == 'Ruang Kelas' ? 'selected' : '' }}>Ruang Kelas</option>
                                    <option value="Laboratorium" {{ old('kategori_pengaduan') == 'Laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                                    <option value="Toilet" {{ old('kategori_pengaduan') == 'Toilet' ? 'selected' : '' }}>Toilet</option>
                                    <option value="Perpustakaan" {{ old('kategori_pengaduan') == 'Perpustakaan' ? 'selected' : '' }}>Perpustakaan</option>
                                    <option value="Kantin" {{ old('kategori_pengaduan') == 'Kantin' ? 'selected' : '' }}>Kantin</option>
                                    <option value="Lapangan" {{ old('kategori_pengaduan') == 'Lapangan' ? 'selected' : '' }}>Lapangan</option>
                                    <option value="Lainnya" {{ old('kategori_pengaduan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('kategori_pengaduan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Detail Pengaduan</label>
                                <textarea name="detail_pengaduan" class="form-control @error('detail_pengaduan') is-invalid @enderror" 
                                          rows="4" placeholder="Jelaskan detail pengaduan sarana/prasarana" required>{{ old('detail_pengaduan') }}</textarea>
                                @error('detail_pengaduan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Foto Sarana (Opsional)</label>
                                <input type="file" name="foto_sarana" class="form-control @error('foto_sarana') is-invalid @enderror" 
                                       accept="image/jpeg,image/png,image/jpg">
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                                @error('foto_sarana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    📤 Kirim Aspirasi
                                </button>
                                <a href="{{ route('aspirasi.daftar') }}" class="btn btn-outline-secondary">
                                    📋 Lihat Daftar Aspirasi
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>