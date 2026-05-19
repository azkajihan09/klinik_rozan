<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1>Dashboard</h1>
<div class="grid">
<?php foreach ($stats as $label => $value): ?>
    <div class="card"><div class="small"><?= esc($label) ?></div><div class="stat"><?= esc($value) ?></div></div>
<?php endforeach; ?>
</div>
<div class="card">
    <h3>Alur Utama SIMRS</h3>
    <p>Pasien → Registrasi → Rawat Jalan / IGD / Rawat Inap → Farmasi / Lab / Radiologi / Operasi → Resume / Rekam Medis → Billing.</p>
</div>
<?= $this->endSection() ?>
