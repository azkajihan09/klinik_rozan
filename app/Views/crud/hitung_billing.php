<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>Ringkasan Billing</h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/billing') ?>">Billing</a> /
            Hitung
        </p>
    </div>
    <a href="<?= site_url('module/billing') ?>" class="btn btn-secondary">← Kembali</a>
</div>

<!-- SUMMARY -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value" style="font-size:14px;word-break:break-all"><?= esc($noRawat) ?></div>
            <div class="stat-label">No Rawat</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">Rp <?= number_format($data['registrasi'], 0, ',', '.') ?></div>
            <div class="stat-label">Biaya Registrasi</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon teal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8.5 14.5L15.5 7.5"/><path d="M14 4l4.5 4.5a5 5 0 010 7.07L14 20.07a5 5 0 01-7.07 0L2.43 15.57a5 5 0 010-7.07L7 4"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= $data['resep'] ?></div>
            <div class="stat-label">Resep Obat</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon amber">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3h6v2H9zM10 5v6.5L6 20h12l-4-8.5V5"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= $data['lab'] + $data['radiologi'] ?></div>
            <div class="stat-label">Order Penunjang</div>
        </div>
    </div>
</div>

<!-- BILLING TABLE -->
<div class="card">
    <div class="card-header">
        <h3>Detail Billing</h3>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Kode Billing</th>
                    <th>Total</th>
                    <th>Potongan</th>
                    <th>Harus Bayar</th>
                    <th>Dibayar</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data['billing'])): ?>
                    <tr><td colspan="7" style="text-align:center;padding:24px;color:#6b7280">Belum ada data billing.</td></tr>
                <?php endif; ?>
                <?php foreach($data['billing'] as $b): ?>
                <tr>
                    <td><code><?= esc($b['kd_billing']) ?></code></td>
                    <td>Rp <?= number_format((float)($b['jumlah_total'] ?? 0), 0, ',', '.') ?></td>
                    <td>Rp <?= number_format((float)($b['potongan'] ?? 0), 0, ',', '.') ?></td>
                    <td><strong>Rp <?= number_format((float)($b['jumlah_harus_bayar'] ?? 0), 0, ',', '.') ?></strong></td>
                    <td>Rp <?= number_format((float)($b['jumlah_bayar'] ?? 0), 0, ',', '.') ?></td>
                    <td><?= esc($b['tgl_billing'] ?? '') ?></td>
                    <td><?= esc($b['jam_billing'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card" style="background:#f0fdf4;border-color:#bbf7d0">
    <p style="font-size:13px;color:#166534">
        <strong>ℹ️ Info:</strong> Perhitungan lengkap tindakan, obat, kamar, operasi, dan penunjang dapat dikembangkan sesuai aturan tarif rumah sakit.
    </p>
</div>

<?= $this->endSection() ?>
