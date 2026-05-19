<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1>Ringkasan Billing</h1>
<div class="card">
<h3>No Rawat: <?= esc($noRawat) ?></h3>
<p>Biaya registrasi: <strong><?= number_format($data['registrasi'],0,',','.') ?></strong></p>
<p>Jumlah resep: <?= esc($data['resep']) ?> | Order lab: <?= esc($data['lab']) ?> | Order radiologi: <?= esc($data['radiologi']) ?></p>
<p class="small">Perhitungan lengkap tindakan, obat, kamar, operasi, dan penunjang dapat dikembangkan sesuai aturan tarif rumah sakit.</p>
</div>
<div class="card"><h3>Billing Tersimpan</h3><table><tr><th>Kode</th><th>Total</th><th>Potongan</th><th>Harus Bayar</th><th>Bayar</th><th>Tanggal</th></tr><?php foreach($data['billing'] as $b): ?><tr><td><?= esc($b['kd_billing']) ?></td><td><?= esc($b['jumlah_total']) ?></td><td><?= esc($b['potongan']) ?></td><td><?= esc($b['jumlah_harus_bayar']) ?></td><td><?= esc($b['jumlah_bayar']) ?></td><td><?= esc($b['tgl_billing']) ?></td></tr><?php endforeach; ?></table></div>
<?= $this->endSection() ?>
