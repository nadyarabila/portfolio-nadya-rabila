<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$item = getAchievementById($id);
if (!$item) {
    setFlash('error', 'Data tidak ditemukan.');
    header('Location: ' . adminUrl('achievements/index.php'));
    exit;
}

$pageTitle = 'Edit Prestasi';
$activePage = 'achievements';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validated = validateAchievementInput($_POST, $_FILES['image'] ?? [], true, (string) $item['image']);
    if ($validated['ok']) {
        if ($validated['data']['image'] !== $item['image']) {
            deleteUploadedImage((string) $item['image']);
        }
        if (updateAchievement($id, $validated['data'])) {
            setFlash('success', 'Prestasi berhasil diperbarui.');
            header('Location: ' . adminUrl('achievements/index.php'));
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
    <div class="panel-header"><h2><i class="fas fa-pen"></i> Edit Prestasi</h2></div>
    <div class="panel-body">
        <?php $isEdit = true; require dirname(__DIR__) . '/partials/achievement-form.php'; ?>
    </div>
</div>
<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
