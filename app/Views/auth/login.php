<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SIMRS Klinik Rozan</title>
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body class="app-login-page">
    <div class="container-fluid">
        <div class="row g-0 align-items-stretch">
            <div class="col-lg-7 d-none d-lg-flex align-items-center app-login-hero">
                <div class="app-login-hero-content">
                    <div class="app-login-brand">
                        <span class="app-login-brand-mark">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                            </svg>
                        </span>
                        <div class="app-login-brand-text">
                            <h1>Klinik Rozan</h1>
                            <p>SIMRS terintegrasi untuk pelayanan klinik yang lebih rapi, cepat, dan terukur.</p>
                        </div>
                    </div>

                    <p class="app-login-lead">
                        Akses dashboard, registrasi, rawat jalan, penunjang, dan billing dari satu sistem yang konsisten dengan alur kerja operasional harian.
                    </p>

                    <div class="app-login-feature-grid">
                        <div class="app-login-feature">
                            <span class="app-icon-chip">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                </svg>
                            </span>
                            <div>
                                <strong>Manajemen Pasien</strong>
                                <span>Data pasien, registrasi, dan riwayat kunjungan.</span>
                            </div>
                        </div>
                        <div class="app-login-feature">
                            <span class="app-icon-chip">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                                </svg>
                            </span>
                            <div>
                                <strong>Pelayanan Klinis</strong>
                                <span>Rawat jalan, IGD, dan rawat inap dalam satu alur.</span>
                            </div>
                        </div>
                        <div class="app-login-feature">
                            <span class="app-icon-chip">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 3h6v2H9zM10 5v6.5L6 20h12l-4-8.5V5" />
                                </svg>
                            </span>
                            <div>
                                <strong>Penunjang Medis</strong>
                                <span>Laboratorium, radiologi, farmasi, dan operasi.</span>
                            </div>
                        </div>
                        <div class="app-login-feature">
                            <span class="app-icon-chip">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="1" y="4" width="22" height="16" rx="2" />
                                    <line x1="1" y1="10" x2="23" y2="10" />
                                </svg>
                            </span>
                            <div>
                                <strong>Billing dan BPJS</strong>
                                <span>Transaksi, klaim, dan monitoring pembayaran.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-flex align-items-center justify-content-center px-3 px-md-4 py-5">
                <div class="app-login-panel">
                    <div class="card app-login-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <span class="app-avatar bg-primary">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                                    </svg>
                                </span>
                                <div>
                                    <h2 class="h3 mb-1">Masuk ke SIMRS</h2>
                                    <p class="text-muted mb-0">Gunakan akun petugas untuk melanjutkan ke sistem Klinik Rozan.</p>
                                </div>
                            </div>

                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= esc($error) ?>
                                </div>
                            <?php endif; ?>

                            <form method="post">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                        </span>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                            </svg>
                                        </span>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-lg mt-2">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                        <polyline points="10 17 15 12 10 7" />
                                        <line x1="15" y1="12" x2="3" y2="12" />
                                    </svg>
                                    Masuk ke Sistem
                                </button>
                            </form>

                            <div class="app-login-note">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 8v4" />
                                    <path d="M12 16h.01" />
                                </svg>
                                Sesi login digunakan untuk mengakses menu sesuai role pengguna.
                            </div>

                            <div class="app-login-footer">
                                &copy; <?= date('Y') ?> Klinik Rozan · SIMRS v1.0
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>