<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$item = getCertificationById($id);
if (!$item) {
    setFlash('error', 'Data tidak ditemukan.');
    header('Location: ' . adminUrl('certifications/index.php'));
    exit;
}

$pageTitle = 'Edit Sertifikat';
$activePage = 'certifications';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validated = validateCertificationInput($_POST, $_FILES['image'] ?? [], true, (string) $item['image']);
    if ($validated['ok']) {
        if ($validated['data']['image'] !== $item['image']) {
            deleteUploadedImage((string) $item['image']);
        }
        if (updateCertification($id, $validated['data'])) {
            setFlash('success', 'Sertifikat berhasil diperbarui.');
            header('Location: ' . adminUrl('certifications/index.php'));
            exit;
        }
        $errors[] = 'Gagal memperbarui database.';
    } else {
        $errors = $validated['errors'];
        $old = $validated['data'];
        $item = array_merge($item, $old);
    }
}

require dirname(__DIR__) . '/partials/layout-start.php';
?>
<div class="panel-card">
    <div class="panel-header"><h2><i class="fas fa-pen"></i> Edit Sertifikat</h2></div>
    <div class="panel-body">
        <?php $isEdit = true; require dirname(__DIR__) . '/partials/certification-form.php'; ?>
    </div>
</div>
<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
