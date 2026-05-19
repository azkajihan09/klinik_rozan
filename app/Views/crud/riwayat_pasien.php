<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>Riwayat Pasien</h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/pasien') ?>">Pasien</a> /
            Riwayat
        </p>
    </div>
    <a href="<?= site_url('module/pasien') ?>" class="btn btn-secondary">← Kembali</a>
</div>

<?php if(!$pasien): ?>
    <div class="card" style="text-align:center;padding:40px">
        <p style="color:#6b7280">Pasien tidak ditemukan.</p>
    </div>
<?php else: ?>

<!-- INFO PASIEN -->
<div class="card">
    <div style="display:flex;align-items:center;gap:16px">
        <div style="width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#0f766e,#065f46);display:flex;align-items:center;justify-content:center;color:white;font-size:22px;font-weight:700">
            <?= strtoupper(substr($pasien['nm_pasien'] ?? 'P', 0, 1)) ?>
        </div>
        <div>
            <h2 style="font-size:20px;margin-bottom:4px"><?= esc($pasien['nm_pasien']) ?></h2>
            <p style="font-size:14px;color:#6b7280">
                <span class="badge badge-info"><?= esc($pasien['no_rkm_medis']) ?></span>
                &middot; <?= esc($pasien['jk'] === 'L' ? 'Laki-laki' : 'Perempuan') ?>
                &middot; <?= esc($pasien['alamat'] ?? '-') ?>
                &middot; <?= esc($pasien['no_tlp'] ?? '-') ?>
            </p>
        </div>
    </div>
</div>

<!-- RIWAYAT KUNJUNGAN -->
<div class="card">
    <div class="card-header">
        <h3>Riwayat Kunjungan</h3>
        <span class="badge badge-info"><?= count($kunjungan) ?> kunjungan</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No Rawat</th>
                    <th>Tanggal</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Status</th>
                    <th>Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($kunjungan)): ?>
                    <tr><td colspan="7" style="text-align:center;padding:24px;color:#6b7280">Belum ada riwayat kunjungan.</td></tr>
                <?php endif; ?>
                <?php foreach($kunjungan as $r): ?>
                <tr>
                    <td><code style="font-size:12px"><?= esc($r['no_rawat']) ?></code></td>
                    <td><?= esc($r['tgl_registrasi']) ?> <span style="color:#9ca3af"><?= esc($r['jam_reg']) ?></span></td>
                    <td><?= esc($r['kd_dokter']) ?></td>
                    <td><?= esc($r['kd_poli']) ?></td>
                    <td>
                        <?php if($r['status_lanjut'] === 'Ralan'): ?>
                            <span class="badge badge-success">Rawat Jalan</span>
                        <?php elseif($r['status_lanjut'] === 'Ranap'): ?>
                            <span class="badge badge-warning">Rawat Inap</span>
                        <?php else: ?>
                            <span class="badge badge-info"><?= esc($r['status_lanjut']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($r['status_bayar'] === 'Sudah Bayar'): ?>
                            <span class="badge badge-success">Lunas</span>
                        <?php else: ?>
                            <span class="badge badge-warning"><?= esc($r['status_bayar']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= site_url('billing/hitung/'.rawurlencode($r['no_rawat'])) ?>" class="btn btn-secondary btn-sm">Billing</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php endif; ?>

<?= $this->endSection() ?>
