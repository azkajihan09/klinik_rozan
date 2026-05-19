<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1><?= esc($cfg['title']) ?></h1>
<?php if(session('success')): ?><div class="alert ok"><?= esc(session('success')) ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="alert err"><?= esc(session('error')) ?></div><?php endif; ?>
<div class="card">
    <form method="get" style="display:flex;gap:8px;align-items:end">
        <div style="flex:1"><label>Cari</label><input name="q" value="<?= esc($keyword ?? '') ?>" placeholder="Cari data..."></div>
        <button class="btn">Cari</button>
        <a class="btn gray" href="<?= site_url('module/'.$moduleKey) ?>">Reset</a>
        <a class="btn" href="<?= site_url('module/'.$moduleKey.'/new') ?>">Tambah</a>
    </form>
</div>
<div class="card" style="overflow:auto">
<table>
    <thead><tr><?php foreach($cfg['list'] as $field): ?><th><?= esc($field) ?></th><?php endforeach; ?><th>Aksi</th></tr></thead>
    <tbody>
    <?php if(empty($rows)): ?><tr><td colspan="99">Belum ada data.</td></tr><?php endif; ?>
    <?php foreach($rows as $row): ?>
    <tr>
        <?php foreach($cfg['list'] as $field): ?><td><?= esc((string)($row[$field] ?? '')) ?></td><?php endforeach; ?>
        <td class="actions">
            <?php $id = rawurlencode((string)($row[$cfg['pk']] ?? '')); ?>
            <a class="btn gray" href="<?= site_url('module/'.$moduleKey.'/edit/'.$id) ?>">Edit</a>
            <?php if($moduleKey === 'pasien'): ?><a class="btn gray" href="<?= site_url('pasien/riwayat/'.$id) ?>">Riwayat</a><?php endif; ?>
            <?php if($moduleKey === 'billing'): ?><a class="btn gray" href="<?= site_url('billing/hitung/'.rawurlencode((string)($row['no_rawat'] ?? ''))) ?>">Hitung</a><?php endif; ?>
            <form method="post" action="<?= site_url('module/'.$moduleKey.'/delete/'.$id) ?>" style="display:inline" onsubmit="return confirm('Hapus data ini?')"><button class="btn red">Hapus</button></form>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination"><?= $pager ? $pager->links() : '' ?></div>
</div>
<?= $this->endSection() ?>
