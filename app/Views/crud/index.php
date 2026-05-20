<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0">
        <div class="app-page-toolbar">
            <div>
                <h1 class="mb-1"><?= esc($cfg['title']) ?></h1>
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= esc($cfg['title']) ?></li>
                </ol>
            </div>
            <a href="<?= site_url('module/' . $moduleKey . '/new') ?>" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Tambah Data
            </a>
        </div>
    </div>
</div>

<?php if (session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= esc(session('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card card-outline card-primary">
    <div class="card-body">
        <form method="get" class="row g-2 align-items-end">
            <div class="col-md-8 col-lg-9">
                <label class="form-label">Cari Data</label>
                <input type="text" name="q" value="<?= esc($keyword ?? '') ?>" placeholder="Cari <?= esc($cfg['title']) ?>..." class="form-control">
            </div>
            <div class="col-md-4 col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    Cari
                </button>
                <?php if ($keyword): ?>
                    <a href="<?= site_url('module/' . $moduleKey) ?>" class="btn btn-outline-secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="1 4 1 10 7 10" />
                            <path d="M3.51 15a9 9 0 1 0 .49-9.36L1 10" />
                        </svg>
                        Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header border-0 app-card-header">
        <h3 class="card-title">Daftar <?= esc($cfg['title']) ?></h3>
        <span class="badge text-bg-info"><?= count($rows) ?> baris</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <?php foreach ($cfg['list'] as $field): ?>
                            <th><?= esc(ucwords(str_replace('_', ' ', $field))) ?></th>
                        <?php endforeach; ?>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rows)): ?>
                        <tr>
                            <td colspan="<?= count($cfg['list']) + 2 ?>" class="app-empty-row">
                                <div class="app-empty-state">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="8" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                    </svg>
                                    <div class="app-empty-title">
                                        <?= $keyword ? 'Data tidak ditemukan' : 'Belum ada data' ?>
                                    </div>
                                    <p class="app-empty-text small">
                                        <?= $keyword ? 'Coba ganti kata kunci pencarian atau reset filter.' : 'Tambah data baru untuk mulai mengisi modul ini.' ?>
                                    </p>
                                    <div class="app-card-actions justify-content-center mt-3">
                                        <?php if ($keyword): ?>
                                            <a href="<?= site_url('module/' . $moduleKey) ?>" class="btn btn-outline-secondary btn-sm">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="1 4 1 10 7 10" />
                                                    <path d="M3.51 15a9 9 0 1 0 .49-9.36L1 10" />
                                                </svg>
                                                Reset Filter
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?= site_url('module/' . $moduleKey . '/new') ?>" class="btn btn-primary btn-sm">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <line x1="12" y1="5" x2="12" y2="19" />
                                                <line x1="5" y1="12" x2="19" y2="12" />
                                            </svg>
                                            Tambah Data
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1;
                        foreach ($rows as $row): ?>
                            <tr>
                                <td class="text-muted small"><?= $no++ ?></td>
                                <?php foreach ($cfg['list'] as $field): ?>
                                    <td><?= esc((string)($row[$field] ?? '')) ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <div class="actions justify-content-end">
                                        <?php $id = rawurlencode((string)($row[$cfg['pk']] ?? '')); ?>
                                        <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('module/' . $moduleKey . '/edit/' . $id) ?>">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.12 2.12 0 1 1 3 3L7 19l-4 1 1-4Z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <?php if ($moduleKey === 'pasien'): ?>
                                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('pasien/riwayat/' . $id) ?>">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="1 4 1 10 7 10" />
                                                    <path d="M3.51 15a9 9 0 1 0 .49-9.36L1 10" />
                                                </svg>
                                                Riwayat
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($moduleKey === 'billing'): ?>
                                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('billing/hitung/' . rawurlencode((string)($row['no_rawat'] ?? ''))) ?>">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <rect x="1" y="4" width="22" height="16" rx="2" />
                                                    <line x1="1" y1="10" x2="23" y2="10" />
                                                </svg>
                                                Hitung
                                            </a>
                                        <?php endif; ?>
                                        <form method="post" action="<?= site_url('module/' . $moduleKey . '/delete/' . $id) ?>" onsubmit="return confirm('Yakin hapus data ini?')">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path d="M19 6l-1 14H6L5 6" />
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M9 6V4h6v2" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if ($pager): ?>
        <div class="card-footer d-flex justify-content-end">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>