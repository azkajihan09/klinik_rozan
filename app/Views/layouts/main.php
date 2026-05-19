<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'CI4 SIMRS') ?></title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;margin:0;background:#f4f7fb;color:#1f2937}.top{background:#12355b;color:white;padding:14px 22px;display:flex;justify-content:space-between;align-items:center}.top a{color:white;text-decoration:none;margin-left:12px}.wrap{display:flex}.side{width:260px;background:white;min-height:calc(100vh - 54px);border-right:1px solid #e5e7eb;padding:16px;box-sizing:border-box}.side a{display:block;padding:9px 10px;border-radius:8px;color:#12355b;text-decoration:none;margin-bottom:4px}.side a:hover{background:#eef5ff}.content{flex:1;padding:22px}.card{background:white;border:1px solid #e5e7eb;border-radius:12px;padding:18px;margin-bottom:16px;box-shadow:0 2px 8px rgba(0,0,0,.03)}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:14px}.stat{font-size:28px;font-weight:700;color:#12355b}.btn{display:inline-block;border:0;background:#12355b;color:white;padding:9px 13px;border-radius:8px;text-decoration:none;cursor:pointer}.btn.red{background:#b91c1c}.btn.gray{background:#6b7280}input,select,textarea{width:100%;box-sizing:border-box;border:1px solid #cbd5e1;border-radius:8px;padding:9px;margin-top:5px}label{font-weight:600;font-size:13px}.formgrid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px}table{width:100%;border-collapse:collapse;background:white}th,td{border-bottom:1px solid #e5e7eb;padding:10px;text-align:left;vertical-align:top}th{background:#f8fafc}.alert{padding:10px;border-radius:8px;margin-bottom:12px}.ok{background:#dcfce7}.err{background:#fee2e2}.small{font-size:12px;color:#64748b}.actions{white-space:nowrap}.pagination a,.pagination strong{padding:6px 9px;margin:2px;border:1px solid #ddd;text-decoration:none;border-radius:5px}
    </style>
</head>
<body>
<div class="top"><div><strong>CI4 SIMRS mLITE</strong></div><div><?= esc(session('fullname') ?? '') ?> <a href="<?= site_url('logout') ?>">Logout</a></div></div>
<div class="wrap">
    <aside class="side">
        <a href="<?= site_url('dashboard') ?>">Dashboard</a>
        <hr>
        <strong class="small">PELAYANAN</strong>
        <a href="<?= site_url('module/pasien') ?>">Pasien</a>
        <a href="<?= site_url('module/registrasi') ?>">Registrasi</a>
        <a href="<?= site_url('module/rawat-jalan') ?>">Rawat Jalan</a>
        <a href="<?= site_url('module/igd') ?>">IGD / Triase</a>
        <a href="<?= site_url('module/rawat-inap') ?>">Rawat Inap</a>
        <a href="<?= site_url('module/laboratorium') ?>">Laboratorium</a>
        <a href="<?= site_url('module/radiologi') ?>">Radiologi</a>
        <a href="<?= site_url('module/operasi') ?>">Operasi</a>
        <a href="<?= site_url('module/farmasi') ?>">Farmasi</a>
        <a href="<?= site_url('module/billing') ?>">Billing</a>
        <hr>
        <strong class="small">ADMIN</strong>
        <a href="<?= site_url('module/bpjs') ?>">BPJS / SEP</a>
        <a href="<?= site_url('module/rekam-medis') ?>">Rekam Medis</a>
        <a href="<?= site_url('module/inventory') ?>">Inventory</a>
        <a href="<?= site_url('module/dokter') ?>">Dokter</a>
        <a href="<?= site_url('module/poli') ?>">Poli</a>
        <a href="<?= site_url('module/bangsal') ?>">Bangsal</a>
        <a href="<?= site_url('module/kamar') ?>">Kamar</a>
        <a href="<?= site_url('module/penjamin') ?>">Penjamin</a>
        <a href="<?= site_url('module/obat') ?>">Obat</a>
        <a href="<?= site_url('module/users') ?>">User & Role</a>
    </aside>
    <main class="content">
        <?= $this->renderSection('content') ?>
    </main>
</div>
</body>
</html>
