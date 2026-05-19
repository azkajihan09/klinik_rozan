<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SIMRS Klinik Rozan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #0891b2 0%, #0e7490 40%, #164e63 100%);
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute; top: -30%; right: -20%;
            width: 600px; height: 600px;
            background: rgba(255,255,255,.04);
            border-radius: 50%;
        }
        body::after {
            content: '';
            position: absolute; bottom: -20%; left: -10%;
            width: 400px; height: 400px;
            background: rgba(255,255,255,.03);
            border-radius: 50%;
        }

        .login-left {
            flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center;
            padding: 60px; color: white; position: relative; z-index: 1;
        }
        .login-left .logo-icon {
            width: 64px; height: 64px; border-radius: 16px;
            background: rgba(255,255,255,.15); backdrop-filter: blur(10px);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 24px; border: 1px solid rgba(255,255,255,.2);
        }
        .login-left .logo-icon svg { width: 32px; height: 32px; }
        .login-left h1 { font-size: 36px; font-weight: 800; margin-bottom: 12px; }
        .login-left p { font-size: 15px; opacity: .85; max-width: 420px; text-align: center; line-height: 1.7; }
        .login-left .features { margin-top: 40px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px; max-width: 440px; }
        .feature-item {
            display: flex; align-items: center; gap: 12px; font-size: 13px; font-weight: 500;
            padding: 12px 16px; border-radius: 12px;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.1);
            backdrop-filter: blur(5px);
        }
        .feature-item svg { width: 20px; height: 20px; flex-shrink: 0; opacity: .8; }

        .login-right {
            width: 480px; display: flex; align-items: center; justify-content: center;
            padding: 40px; position: relative; z-index: 1;
        }
        .login-box {
            width: 100%; max-width: 400px;
            background: white; border-radius: 24px;
            padding: 44px 36px;
            box-shadow: 0 25px 60px rgba(0,0,0,.25);
        }
        .login-box .box-logo {
            width: 52px; height: 52px; border-radius: 14px;
            background: linear-gradient(135deg, #0891b2, #06b6d4);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 28px;
            box-shadow: 0 8px 20px rgba(8,145,178,.3);
        }
        .login-box .box-logo svg { width: 26px; height: 26px; color: white; }
        .login-box h2 { font-size: 22px; font-weight: 700; color: #1e293b; margin-bottom: 6px; }
        .login-box .subtitle { font-size: 14px; color: #64748b; margin-bottom: 32px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px; }
        .form-group input {
            width: 100%; padding: 13px 16px;
            border: 1.5px solid #e2e8f0; border-radius: 12px;
            font-size: 14px; font-family: inherit; transition: .2s;
        }
        .form-group input:focus { outline: none; border-color: #0891b2; box-shadow: 0 0 0 3px rgba(8,145,178,.1); }
        .form-group input::placeholder { color: #94a3b8; }

        .btn-login {
            width: 100%; padding: 14px; border: none; border-radius: 12px;
            background: linear-gradient(135deg, #0891b2, #06b6d4);
            color: white; font-size: 15px; font-weight: 600; font-family: inherit;
            cursor: pointer; transition: .2s; margin-top: 8px;
            box-shadow: 0 4px 14px rgba(8,145,178,.3);
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(8,145,178,.4); }
        .btn-login:active { transform: translateY(0); }

        .error-msg {
            background: #fef2f2; color: #991b1b; padding: 12px 16px;
            border-radius: 10px; font-size: 13px; margin-bottom: 20px;
            border: 1px solid #fecaca; font-weight: 500;
        }

        .login-footer { text-align: center; margin-top: 28px; font-size: 12px; color: #94a3b8; }

        @media (max-width: 900px) {
            .login-left { display: none; }
            .login-right { width: 100%; padding: 24px; }
            body { justify-content: center; align-items: center; }
        }
    </style>
</head>
<body>
    <div class="login-left">
        <div class="logo-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
            </svg>
        </div>
        <h1>Klinik Rozan</h1>
        <p>Sistem Informasi Manajemen Rumah Sakit terintegrasi untuk pelayanan kesehatan yang lebih baik dan efisien.</p>
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
            <div class="box-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                </svg>
            </div>
            <h2>Selamat Datang</h2>
            <p class="subtitle">Masuk ke SIMRS Klinik Rozan</p>

            <?php if(!empty($error)): ?>
                <div class="error-msg">⚠️ <?= esc($error) ?></div>
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
