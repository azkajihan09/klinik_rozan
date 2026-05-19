<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1><?= esc($cfg['title']) ?></h1>
        <p class="breadcrumb"><a href="<?= site_url('dashboard') ?>">Dashboard</a> / <?= esc($cfg['title']) ?></p>
    </div>
    <a href="<?= site_url('module/'.$moduleKey.'/new') ?>" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Data
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <?= esc(session('success')) ?>
    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        <?= esc(session('error')) ?>
    </div>
<?php endif; ?>

<!-- SEARCH -->
<div class="card">
    <form method="get" class="search-bar">
        <input type="text" name="q" value="<?= esc($keyword ?? '') ?>" placeholder="Cari <?= esc($cfg['title']) ?>..." class="form-control">
        <button type="submit" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Cari
        </button>
        <?php if($keyword): ?>
            <a href="<?= site_url('module/'.$moduleKey) ?>" class="btn btn-secondary">Reset</a>
        <?php endif; ?>
    </form>
</div>

<!-- TABLE -->
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <?php foreach($cfg['list'] as $field): ?>
                        <th><?= esc(ucwords(str_replace('_', ' ', $field))) ?></th>
                    <?php endforeach; ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($rows)): ?>
                    <tr><td colspan="<?= count($cfg['list']) + 2 ?>" style="text-align:center;padding:32px;color:#6b7280">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" style="margin:0 auto 8px;display:block"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Belum ada data<?= $keyword ? ' untuk pencarian "'.esc($keyword).'"' : '' ?>.
                    </td></tr>
                <?php else: ?>
                    <?php $no = 1; foreach($rows as $row): ?>
                    <tr>
                        <td style="color:#9ca3af;font-size:12px"><?= $no++ ?></td>
                        <?php foreach($cfg['list'] as $field): ?>
                            <td><?= esc((string)($row[$field] ?? '')) ?></td>
                        <?php endforeach; ?>
                        <td class="actions">
                            <?php $id = rawurlencode((string)($row[$cfg['pk']] ?? '')); ?>
                            <a class="btn btn-secondary btn-sm" href="<?= site_url('module/'.$moduleKey.'/edit/'.$id) ?>">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>
                            <?php if($moduleKey === 'pasien'): ?>
                                <a class="btn btn-secondary btn-sm" href="<?= site_url('pasien/riwayat/'.$id) ?>">Riwayat</a>
                            <?php endif; ?>
                            <?php if($moduleKey === 'billing'): ?>
                                <a class="btn btn-secondary btn-sm" href="<?= site_url('billing/hitung/'.rawurlencode((string)($row['no_rawat'] ?? ''))) ?>">Hitung</a>
                            <?php endif; ?>
                            <form method="post" action="<?= site_url('module/'.$moduleKey.'/delete/'.$id) ?>" style="display:inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($pager): ?>
        <div class="pagination"><?= $pager->links() ?></div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
