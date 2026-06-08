<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Upload Galeri';
$activePage = 'gallery';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validated = validateGalleryInput($_POST, $_FILES['image'] ?? [], false, null);
    if ($validated['ok'] && createGalleryItem($validated['data'])) {
        setFlash('success', 'Foto galeri berhasil diunggah.');
        header('Location: ' . adminUrl('gallery/index.php'));
        exit;
    }
    $errors = $validated['errors'] ?: ['Gagal menyimpan ke database.'];
    $old = $validated['data'];
}

require dirname(__DIR__) . '/partials/layout-start.php';
?>
<div class="panel-card">
    <div class="panel-header"><h2><i class="fas fa-upload"></i> Upload Foto Galeri</h2></div>
    <div class="panel-body">
        <?php $isEdit = false; $item = null; require dirname(__DIR__) . '/partials/gallery-form.php'; ?>
    </div>
</div>
<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
