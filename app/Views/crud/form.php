<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1><?= $mode === 'create' ? 'Tambah' : 'Edit' ?> <?= esc($cfg['title']) ?></h1>
<div class="card">
<form method="post" action="<?= $mode === 'create' ? site_url('module/'.$moduleKey) : site_url('module/'.$moduleKey.'/update/'.rawurlencode((string)($row[$cfg['pk']] ?? ''))) ?>">
    <div class="formgrid">
    <?php foreach($cfg['form'] as $field): ?>
        <?php $value = $row[$field] ?? ''; ?>
        <div>
            <label><?= esc($field) ?></label>
            <?php if(str_contains($field, 'alamat') || str_contains($field, 'hasil') || str_contains($field, 'keluhan') || str_contains($field, 'pemeriksaan') || str_contains($field, 'penilaian') || str_contains($field, 'instruksi') || str_contains($field, 'evaluasi') || str_contains($field, 'access')): ?>
                <textarea name="<?= esc($field) ?>" rows="3"><?= esc($value) ?></textarea>
            <?php elseif(str_contains($field, 'tgl') || $field === 'tanggal_lahir' || $field === 'tanggal'): ?>
                <input type="date" name="<?= esc($field) ?>" value="<?= esc($value) ?>">
            <?php elseif(str_contains($field, 'jam')): ?>
                <input type="time" name="<?= esc($field) ?>" value="<?= esc($value) ?>">
            <?php elseif(str_contains($field, 'password')): ?>
                <input type="password" name="<?= esc($field) ?>" value="" placeholder="Kosongkan jika tidak diubah">
            <?php elseif(str_contains($field, 'email')): ?>
                <input type="email" name="<?= esc($field) ?>" value="<?= esc($value) ?>">
            <?php elseif(str_contains($field, 'biaya') || str_contains($field, 'jumlah') || str_contains($field, 'tarif') || str_contains($field, 'stok') || str_contains($field, 'umur') || in_array($field, ['nadi','respirasi','spo2','lama','ttl_biaya','h_beli','ralan','potongan'])): ?>
                <input type="number" step="any" name="<?= esc($field) ?>" value="<?= esc($value) ?>">
            <?php else: ?>
                <input name="<?= esc($field) ?>" value="<?= esc($value) ?>">
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    </div>
    <p><button class="btn">Simpan</button> <a class="btn gray" href="<?= site_url('module/'.$moduleKey) ?>">Kembali</a></p>
</form>
</div>
<?= $this->endSection() ?>
