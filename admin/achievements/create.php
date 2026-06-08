<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Tambah Prestasi';
$activePage = 'achievements';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validated = validateAchievementInput($_POST, $_FILES['image'] ?? [], false, null);
    if ($validated['ok'] && createAchievement($validated['data'])) {
        setFlash('success', 'Prestasi berhasil ditambahkan.');
        header('Location: ' . adminUrl('achievements/index.php'));
        exit;
    }
    $errors = $validated['errors'] ?: ['Gagal menyimpan ke database.'];
    $old = $validated['data'];
}

require dirname(__DIR__) . '/partials/layout-start.php';
?>
<div class="panel-card">
    <div class="panel-header"><h2><i class="fas fa-plus"></i> Tambah Prestasi</h2></div>
    <div class="panel-body">
        <?php $isEdit = false; $item = null; require dirname(__DIR__) . '/partials/achievement-form.php'; ?>
    </div>
</div>
<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
