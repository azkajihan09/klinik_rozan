<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO CARD -->
<div class="hero-card animate-fade-up">
    <h2>🏥 Selamat Datang di SIMRS Klinik Rozan</h2>
    <p>Sistem informasi manajemen rumah sakit terintegrasi untuk pelayanan kesehatan yang lebih baik, cepat, dan akurat.</p>
    <div class="hero-stats">
        <div class="hero-stat">
            <div class="hero-stat-value"><?= number_format($stats['Pasien'] ?? 0) ?></div>
            <div class="hero-stat-label">Total Pasien</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-value"><?= number_format($stats['Registrasi Hari Ini'] ?? 0) ?></div>
            <div class="hero-stat-label">Kunjungan Hari Ini</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-value"><?= number_format($stats['Rawat Inap Aktif'] ?? 0) ?></div>
            <div class="hero-stat-label">Rawat Inap</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-value"><?= number_format($stats['Billing Hari Ini'] ?? 0) ?></div>
            <div class="hero-stat-label">Transaksi</div>
        </div>
    </div>
</div>

<!-- STATISTIK -->
<div class="stats-grid animate-fade-up" style="animation-delay:.1s">
    <div class="stat-card stat-blue">
        <div class="stat-icon teal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($stats['Pasien'] ?? 0) ?></div>
            <div class="stat-label">Total Pasien</div>
        </div>
    </div>
    <div class="stat-card stat-green">
        <div class="stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($stats['Registrasi Hari Ini'] ?? 0) ?></div>
            <div class="stat-label">Pasien Hari Ini</div>
        </div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon purple">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($stats['Dokter Aktif'] ?? 0) ?></div>
            <div class="stat-label">Dokter Aktif</div>
        </div>
    </div>
    <div class="stat-card stat-orange">
        <div class="stat-icon orange">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($stats['Rawat Jalan Hari Ini'] ?? 0) ?></div>
            <div class="stat-label">Antrian Berjalan</div>
        </div>
    </div>
</div>

<!-- PELAYANAN CEPAT -->
<div class="card animate-fade-up" style="animation-delay:.2s">
    <div class="card-header">
        <h3>⚡ Pelayanan Cepat</h3>
    </div>
    <div class="flow-grid">
        <a href="<?= site_url('module/pasien/new') ?>" class="flow-card">
            <div class="flow-icon fc-blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            </div>
            <div class="flow-label">Pendaftaran Pasien</div>
            <div class="flow-desc">Daftar pasien baru</div>
        </a>
        <a href="<?= site_url('module/registrasi/new') ?>" class="flow-card">
            <div class="flow-icon fc-teal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div class="flow-label">Registrasi</div>
            <div class="flow-desc">Daftar kunjungan</div>
        </a>
        <a href="<?= site_url('module/dokter') ?>" class="flow-card">
            <div class="flow-icon fc-purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div class="flow-label">Cek Jadwal</div>
            <div class="flow-desc">Jadwal dokter</div>
        </a>
        <a href="<?= site_url('module/rekam-medis') ?>" class="flow-card">
            <div class="flow-icon fc-green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
            </div>
            <div class="flow-label">Rekam Medis</div>
            <div class="flow-desc">Berkas digital</div>
        </a>
        <a href="<?= site_url('module/farmasi/new') ?>" class="flow-card">
            <div class="flow-icon fc-orange">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8.5 14.5L15.5 7.5"/><path d="M14 4l4.5 4.5a5 5 0 010 7.07L14 20.07a5 5 0 01-7.07 0L2.43 15.57a5 5 0 010-7.07L7 4"/></svg>
            </div>
            <div class="flow-label">Resep Obat</div>
            <div class="flow-desc">Farmasi</div>
        </a>
        <a href="<?= site_url('module/billing') ?>" class="flow-card">
            <div class="flow-icon fc-pink">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            </div>
            <div class="flow-label">Pembayaran</div>
            <div class="flow-desc">Billing & kasir</div>
        </a>
    </div>
</div>

<!-- GRID: JADWAL DOKTER + ANTRIAN -->
<div class="grid-3 animate-fade-up" style="animation-delay:.3s">
    <!-- ANTRIAN PASIEN -->
    <div class="card">
        <div class="card-header">
            <h3>📋 Antrian Pasien Hari Ini</h3>
            <a href="<?= site_url('module/registrasi') ?>" class="btn btn-sm btn-secondary">Lihat Semua</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($antrian)): ?>
                        <?php foreach($antrian as $i => $a): ?>
                        <tr>
                            <td><strong><?= str_pad((string)($i+1), 3, '0', STR_PAD_LEFT) ?></strong></td>
                            <td><?= esc($a['no_rkm_medis']) ?></td>
                            <td><?= esc($a['kd_poli']) ?></td>
                            <td><?= esc($a['kd_dokter']) ?></td>
                            <td>
                                <?php if($a['stts'] === 'Sudah'): ?>
                                    <span class="badge badge-success">Selesai</span>
                                <?php elseif($a['stts'] === 'Berkas Diterima'): ?>
                                    <span class="badge badge-info">Proses</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Menunggu</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="text-align:center;padding:24px;color:var(--text-muted)">Belum ada antrian hari ini</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JADWAL DOKTER -->
    <div class="card">
        <div class="card-header">
            <h3>👨‍⚕️ Dokter Aktif</h3>
            <a href="<?= site_url('module/dokter') ?>" class="btn btn-sm btn-secondary">Semua</a>
        </div>
        <?php if(!empty($dokter_list)): ?>
            <?php
            $colors = ['#0891b2','#6366f1','#10b981','#f59e0b','#ec4899','#8b5cf6','#ef4444'];
            foreach($dokter_list as $i => $d):
                $color = $colors[$i % count($colors)];
            ?>
            <div class="doctor-item">
                <div class="doctor-avatar" style="background:<?= $color ?>">
                    <?= strtoupper(substr($d['nm_dokter'] ?? 'D', 0, 1)) ?>
                </div>
                <div class="doctor-info">
                    <div class="doctor-name"><?= esc($d['nm_dokter']) ?></div>
                    <div class="doctor-spec"><?= esc($d['kd_sps'] ?? 'Umum') ?></div>
                </div>
                <div class="doctor-schedule">
                    <span class="badge badge-online">Aktif</span>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;padding:20px;color:var(--text-muted);font-size:13px">Belum ada data dokter</p>
        <?php endif; ?>
    </div>
</div>

<!-- STATISTIK TAMBAHAN -->
<div class="stats-grid animate-fade-up" style="animation-delay:.4s">
    <div class="stat-card stat-pink">
        <div class="stat-icon pink">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8.5 14.5L15.5 7.5"/><path d="M14 4l4.5 4.5a5 5 0 010 7.07L14 20.07a5 5 0 01-7.07 0L2.43 15.57a5 5 0 010-7.07L7 4"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($stats['Resep Hari Ini'] ?? 0) ?></div>
            <div class="stat-label">Resep Hari Ini</div>
        </div>
    </div>
    <div class="stat-card stat-indigo">
        <div class="stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3h6v2H9zM10 5v6.5L6 20h12l-4-8.5V5"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($stats['Order Lab Hari Ini'] ?? 0) ?></div>
            <div class="stat-label">Order Lab</div>
        </div>
    </div>
    <div class="stat-card stat-amber">
        <div class="stat-icon amber">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="2"/><circle cx="12" cy="12" r="4"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($stats['Order Radiologi Hari Ini'] ?? 0) ?></div>
            <div class="stat-label">Order Radiologi</div>
        </div>
    </div>
    <div class="stat-card stat-red">
        <div class="stat-icon red">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($stats['Rawat Inap Aktif'] ?? 0) ?></div>
            <div class="stat-label">Rawat Inap Aktif</div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
