<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1><?= $mode === 'create' ? 'Tambah' : 'Edit' ?> <?= esc($cfg['title']) ?></h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/'.$moduleKey) ?>"><?= esc($cfg['title']) ?></a> /
            <?= $mode === 'create' ? 'Tambah' : 'Edit' ?>
        </p>
    </div>
</div>

<div class="card">
    <form method="post" action="<?= $mode === 'create' ? site_url('module/'.$moduleKey) : site_url('module/'.$moduleKey.'/update/'.rawurlencode((string)($row[$cfg['pk']] ?? ''))) ?>">
        <div class="form-grid">
            <?php foreach($cfg['form'] as $field): ?>
                <?php $value = $row[$field] ?? ''; ?>
                <div class="form-group">
                    <label class="form-label"><?= esc(ucwords(str_replace('_', ' ', $field))) ?></label>
                    <?php if(str_contains($field, 'alamat') || str_contains($field, 'hasil') || str_contains($field, 'keluhan') || str_contains($field, 'pemeriksaan') || str_contains($field, 'penilaian') || str_contains($field, 'instruksi') || str_contains($field, 'evaluasi') || str_contains($field, 'access') || str_contains($field, 'catatan')): ?>
                        <textarea name="<?= esc($field) ?>" class="form-control" rows="3"><?= esc($value) ?></textarea>
                    <?php elseif(str_contains($field, 'tgl') || $field === 'tanggal_lahir' || $field === 'tanggal'): ?>
                        <input type="date" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control">
                    <?php elseif(str_contains($field, 'jam')): ?>
                        <input type="time" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control">
                    <?php elseif(str_contains($field, 'password')): ?>
                        <input type="password" name="<?= esc($field) ?>" value="" class="form-control" placeholder="Kosongkan jika tidak diubah">
                    <?php elseif(str_contains($field, 'email')): ?>
                        <input type="email" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control">
                    <?php elseif($field === 'jk' || $field === 'jkel'): ?>
                        <select name="<?= esc($field) ?>" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="L" <?= $value === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $value === 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    <?php elseif($field === 'status' || $field === 'status_lanjut'): ?>
                        <select name="<?= esc($field) ?>" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="Ralan" <?= $value === 'Ralan' ? 'selected' : '' ?>>Rawat Jalan</option>
                            <option value="Ranap" <?= $value === 'Ranap' ? 'selected' : '' ?>>Rawat Inap</option>
                            <option value="1" <?= $value === '1' ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= $value === '0' ? 'selected' : '' ?>>Non-Aktif</option>
                        </select>
                    <?php elseif(str_contains($field, 'biaya') || str_contains($field, 'jumlah') || str_contains($field, 'tarif') || str_contains($field, 'stok') || str_contains($field, 'umur') || in_array($field, ['nadi','respirasi','spo2','lama','ttl_biaya','h_beli','ralan','potongan','trf_kamar','registrasi','registrasilama'])): ?>
                        <input type="number" step="any" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control">
                    <?php else: ?>
                        <input type="text" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="margin-top:24px;display:flex;gap:10px">
            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Simpan
            </button>
            <a href="<?= site_url('module/'.$moduleKey) ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
