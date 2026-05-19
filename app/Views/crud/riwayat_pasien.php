<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1>Riwayat Pasien</h1>
<div class="card">
<?php if(!$pasien): ?>Pasien tidak ditemukan.<?php else: ?>
<h3><?= esc($pasien['nm_pasien']) ?> <span class="small">/ <?= esc($pasien['no_rkm_medis']) ?></span></h3>
<p><?= esc($pasien['alamat'] ?? '') ?> | <?= esc($pasien['no_tlp'] ?? '') ?></p>
<?php endif; ?>
</div>
<div class="card"><h3>Riwayat Kunjungan</h3><table><tr><th>No Rawat</th><th>Tanggal</th><th>Dokter</th><th>Poli</th><th>Status</th><th>Bayar</th></tr><?php foreach($kunjungan as $r): ?><tr><td><?= esc($r['no_rawat']) ?></td><td><?= esc($r['tgl_registrasi']) ?> <?= esc($r['jam_reg']) ?></td><td><?= esc($r['kd_dokter']) ?></td><td><?= esc($r['kd_poli']) ?></td><td><?= esc($r['status_lanjut']) ?> / <?= esc($r['stts']) ?></td><td><?= esc($r['status_bayar']) ?></td></tr><?php endforeach; ?></table></div>
<?= $this->endSection() ?>
