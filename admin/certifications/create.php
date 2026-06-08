<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Tambah Sertifikat';
$activePage = 'certifications';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validated = validateCertificationInput($_POST, $_FILES['image'] ?? [], false, null);
    if ($validated['ok'] && createCertification($validated['data'])) {
        setFlash('success', 'Sertifikat berhasil ditambahkan.');
        header('Location: ' . adminUrl('certifications/index.php'));
        exit;
    }
    $errors = $validated['errors'] ?: ['Gagal menyimpan ke database.'];
    $old = $validated['data'];
}

require dirname(__DIR__) . '/partials/layout-start.php';
?>
<div class="panel-card">
    <div class="panel-header"><h2><i class="fas fa-plus"></i> Tambah Sertifikat</h2></div>
    <div class="panel-body">
        <?php $isEdit = false; $item = null; require dirname(__DIR__) . '/partials/certification-form.php'; ?>
    </div>
</div>
<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
