<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SIMRS Klinik Rozan</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #0f766e 0%, #065f46 50%, #064e3b 100%);
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle at 30% 50%, rgba(255,255,255,.05) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(255,255,255,.03) 0%, transparent 40%);
            animation: float 20s ease-in-out infinite;
        }
        @keyframes float { 0%,100%{transform:translate(0,0)} 50%{transform:translate(-20px,20px)} }

        .login-left {
            flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center;
            padding: 40px; color: white; position: relative; z-index: 1;
        }
        .login-left h1 { font-size: 42px; font-weight: 800; margin-bottom: 12px; }
        .login-left p { font-size: 16px; opacity: .85; max-width: 400px; text-align: center; line-height: 1.7; }
        .login-left .features { margin-top: 32px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px; max-width: 420px; }
        .feature-item { display: flex; align-items: center; gap: 10px; font-size: 14px; opacity: .9; }
        .feature-item svg { width: 20px; height: 20px; flex-shrink: 0; opacity: .7; }

        .login-right {
            width: 460px; display: flex; align-items: center; justify-content: center;
            padding: 40px; position: relative; z-index: 1;
        }
        .login-box {
            width: 100%; max-width: 380px;
            background: white; border-radius: 20px;
            padding: 40px 32px;
            box-shadow: 0 25px 50px rgba(0,0,0,.2);
        }
        .login-box .logo {
            width: 56px; height: 56px; border-radius: 14px;
            background: linear-gradient(135deg, #0f766e, #065f46);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 24px;
        }
        .login-box .logo svg { width: 28px; height: 28px; color: white; }
        .login-box h2 { font-size: 22px; font-weight: 700; color: #1f2937; margin-bottom: 6px; }
        .login-box .subtitle { font-size: 14px; color: #6b7280; margin-bottom: 28px; }

        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .form-group input {
            width: 100%; padding: 12px 16px;
            border: 1.5px solid #e5e7eb; border-radius: 10px;
            font-size: 14px; transition: .2s;
        }
        .form-group input:focus { outline: none; border-color: #0f766e; box-shadow: 0 0 0 3px rgba(15,118,110,.1); }

        .btn-login {
            width: 100%; padding: 13px; border: none; border-radius: 10px;
            background: linear-gradient(135deg, #0f766e, #065f46);
            color: white; font-size: 15px; font-weight: 600;
            cursor: pointer; transition: .2s; margin-top: 8px;
        }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(15,118,110,.3); }

        .error-msg {
            background: #fee2e2; color: #991b1b; padding: 10px 14px;
            border-radius: 8px; font-size: 13px; margin-bottom: 16px;
            border: 1px solid #fecaca;
        }

        .login-footer { text-align: center; margin-top: 24px; font-size: 12px; color: #9ca3af; }

        @media (max-width: 900px) {
            .login-left { display: none; }
            .login-right { width: 100%; }
            body { justify-content: center; align-items: center; }
        }
    </style>
</head>
<body>
    <div class="login-left">
        <h1>Klinik Rozan</h1>
        <p>Sistem Informasi Manajemen Rumah Sakit terintegrasi untuk pelayanan kesehatan yang lebih baik.</p>
        <div class="features">
            <div class="feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                Manajemen Pasien
            </div>
            <div class="feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                Rawat Jalan & Inap
            </div>
            <div class="feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3h6v2H9zM10 5v6.5L6 20h12l-4-8.5V5"/></svg>
                Lab & Radiologi
            </div>
            <div class="feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                Billing & BPJS
            </div>
        </div>
    </div>
    <div class="login-right">
        <div class="login-box">
            <div class="logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <h2>Selamat Datang</h2>
            <p class="subtitle">Masuk ke SIMRS Klinik Rozan</p>

            <?php if(!empty($error)): ?>
                <div class="error-msg"><?= esc($error) ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username" required autofocus>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <div class="login-footer">
                &copy; <?= date('Y') ?> Klinik Rozan &middot; SIMRS v1.0
            </div>
        </div>
    </div>
</body>
</html>
