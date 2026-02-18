<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .register-card {
            width: 100%;
            max-width: 450px;
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            overflow: hidden;
        }
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .register-body { padding: 30px; }
        .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.2); }
        .btn-register {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-size: 1rem;
        }
        .btn-register:hover { color: white; opacity: 0.9; }
        .password-strength { height: 4px; border-radius: 2px; transition: all 0.3s; }
    </style>
</head>
<body>
<div class="register-card card">
    <div class="register-header">
        <div style="font-size:2.5rem">📝</div>
        <h4 class="mb-1 fw-bold">Daftar Akun Admin</h4>
        <small class="opacity-75">Sistem Pengaduan Sarana Sekolah</small>
    </div>
    <div class="register-body">

        @if($errors->any())
            <div class="alert alert-danger py-2">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.register.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Contoh: Budi Santoso"
                       required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="admin@sekolah.com"
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Minimal 6 karakter"
                       id="password"
                       required>
                <div class="password-strength mt-1 bg-secondary" id="strengthBar" style="width:0%"></div>
                <small class="text-muted" id="strengthText"></small>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password"
                       required>
            </div>

            <button type="submit" class="btn btn-register w-100 fw-semibold">
                ✅ Buat Akun Admin
            </button>
        </form>

        <hr class="mt-4">
        <div class="text-center">
            <span class="text-muted small">Sudah punya akun?</span>
            <a href="{{ route('admin.login') }}" class="ms-1 small fw-semibold">Login di sini</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('password').addEventListener('input', function () {
        const val = this.value;
        const bar = document.getElementById('strengthBar');
        const txt = document.getElementById('strengthText');
        let strength = 0;
        if (val.length >= 6) strength++;
        if (val.length >= 10) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[^A-Za-z0-9]/.test(val)) strength++;

        const levels = [
            { w: '0%',   c: 'bg-secondary', t: '' },
            { w: '25%',  c: 'bg-danger',    t: 'Lemah' },
            { w: '50%',  c: 'bg-warning',   t: 'Cukup' },
            { w: '75%',  c: 'bg-info',      t: 'Kuat' },
            { w: '100%', c: 'bg-success',   t: 'Sangat Kuat' },
        ];
        const lvl = levels[Math.min(strength, 4)];
        bar.style.width = lvl.w;
        bar.className = 'password-strength mt-1 ' + lvl.c;
        txt.textContent = lvl.t;
    });
</script>
</body>
</html>
