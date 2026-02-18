<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #e94560 0%, #0f3460 100%);
            padding: 35px 30px;
            text-align: center;
            color: white;
        }
        .login-header .icon {
            font-size: 3rem;
            margin-bottom: 10px;
        }
        .login-body { padding: 35px 30px; }
        .form-control:focus { border-color: #e94560; box-shadow: 0 0 0 0.2rem rgba(233,69,96,0.2); }
        .btn-login {
            background: linear-gradient(135deg, #e94560, #0f3460);
            border: none;
            color: white;
            padding: 12px;
            font-size: 1rem;
            border-radius: 10px;
        }
        .btn-login:hover { color: white; opacity: 0.9; }
        .divider { color: #aaa; text-align: center; margin: 15px 0; position: relative; }
        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 42%;
            height: 1px;
            background: #ddd;
        }
        .divider::before { left: 0; }
        .divider::after  { right: 0; }
    </style>
</head>
<body>
<div class="login-card card">
    <div class="login-header">
        <div class="icon">🛠️</div>
        <h4 class="mb-1 fw-bold">Panel Admin</h4>
        <small class="opacity-75">Sistem Pengaduan Sarana Sekolah</small>
    </div>
    <div class="login-body">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show py-2">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="admin@sekolah.com"
                       required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="••••••••"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label text-muted" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-login w-100 fw-semibold">
                🔐 Masuk sebagai Admin
            </button>
        </form>

        <div class="divider mt-4">atau</div>

        <div class="text-center">
            <span class="text-muted small">Belum punya akun admin?</span><br>
            <a href="{{ route('admin.register') }}" class="btn btn-outline-secondary btn-sm mt-2 px-4">
                📝 Daftar Akun Admin
            </a>
        </div>

        <hr class="mt-4">
        <div class="text-center">
            <a href="{{ route('aspirasi.form') }}" class="text-muted small">← Kembali ke Halaman Siswa</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
