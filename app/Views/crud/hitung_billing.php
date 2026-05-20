<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="mb-1">Ringkasan Billing</h1>
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('module/billing') ?>">Billing</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hitung</li>
            </ol>
        </div>
        <a href="<?= site_url('module/billing') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="info-box shadow-sm"><span class="info-box-icon text-bg-primary">#</span>
            <div class="info-box-content"><span class="info-box-text">No Rawat</span><span class="info-box-number fs-6"><?= esc($noRawat) ?></span></div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="info-box shadow-sm"><span class="info-box-icon text-bg-success">Rp</span>
            <div class="info-box-content"><span class="info-box-text">Biaya Registrasi</span><span class="info-box-number">Rp <?= number_format($data['registrasi'], 0, ',', '.') ?></span></div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="info-box shadow-sm"><span class="info-box-icon text-bg-info"><?= (int)$data['resep'] ?></span>
            <div class="info-box-content"><span class="info-box-text">Resep Obat</span><span class="info-box-number"><?= $data['resep'] ?></span></div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="info-box shadow-sm"><span class="info-box-icon text-bg-warning"><?= (int)($data['lab'] + $data['radiologi']) ?></span>
            <div class="info-box-content"><span class="info-box-text">Order Penunjang</span><span class="info-box-number"><?= $data['lab'] + $data['radiologi'] ?></span></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header app-card-header">
        <h3 class="card-title">Detail Billing</h3>
        <span class="badge text-bg-info"><?= count($data['billing']) ?> transaksi</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
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
                <tbody><?php if (empty($data['billing'])): ?><tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data billing.</td>
                        </tr><?php endif; ?><?php foreach ($data['billing'] as $b): ?><tr>
                            <td><code><?= esc($b['kd_billing']) ?></code></td>
                            <td>Rp <?= number_format((float)($b['jumlah_total'] ?? 0), 0, ',', '.') ?></td>
                            <td>Rp <?= number_format((float)($b['potongan'] ?? 0), 0, ',', '.') ?></td>
                            <td><strong>Rp <?= number_format((float)($b['jumlah_harus_bayar'] ?? 0), 0, ',', '.') ?></strong></td>
                            <td>Rp <?= number_format((float)($b['jumlah_bayar'] ?? 0), 0, ',', '.') ?></td>
                            <td><?= esc($b['tgl_billing'] ?? '') ?></td>
                            <td><?= esc($b['jam_billing'] ?? '') ?></td>
                        </tr><?php endforeach; ?></tbody>
            </table>
        </div>
    </div>
    <div class="card-footer app-action-bar">
        <p class="text-muted small mb-0">Perhitungan lengkap tindakan, obat, kamar, operasi, dan penunjang dapat dikembangkan sesuai aturan tarif rumah sakit.</p>
        <a href="<?= site_url('module/billing') ?>" class="btn btn-outline-secondary btn-sm">Kembali ke Billing</a>
    </div>
</div>

<?= $this->endSection() ?>