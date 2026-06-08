<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$contact = getContactById($id);

if (!$contact) {
    setFlash('error', 'Data kontak tidak ditemukan.');
    header('Location: ' . adminUrl('contacts/index.php'));
    exit;
}

$pageTitle = 'Edit Kontak';
$activePage = 'contacts';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validated = validateContactInput($_POST);
    if ($validated['ok']) {
        if (updateContact($id, $validated['data'])) {
            setFlash('success', 'Kontak berhasil diperbarui.');
            header('Location: ' . adminUrl('contacts/index.php'));
            exit;
        }
        $errors[] = 'Gagal memperbarui database.';
    } else {
        $errors = $validated['errors'];
        $old = $validated['data'];
        $contact = array_merge($contact, $old);
    }
}

require dirname(__DIR__) . '/partials/layout-start.php';

$val = function (string $key) use ($contact) {
    return (string) ($contact[$key] ?? '');
};
?>

<div class="panel-card">
    <div class="panel-header">
        <h2><i class="fas fa-pen"></i> Edit Kontak: <?= e($val('platform')) ?></h2>
    </div>
    <div class="panel-body">
        <?php if ($errors !== []): ?>
            <div class="alert alert-error" role="alert">
                <i class="fas fa-circle-exclamation"></i>
                <ul class="error-list"><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul>
            </div>
        <?php endif; ?>

        <form method="post" class="admin-form">
            <div class="form-grid">
                <div class="form-group">
                    <label for="platform">Platform <span class="required">*</span></label>
                    <input type="text" id="platform" name="platform" value="<?= e($val('platform')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="label">Label <span class="required">*</span></label>
                    <input type="text" id="label" name="label" value="<?= e($val('label')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username <span class="required">*</span></label>
                    <input type="text" id="username" name="username" value="<?= e($val('username')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="icon_class">Icon Class <span class="hint">(FontAwesome)</span></label>
                    <input type="text" id="icon_class" name="icon_class" value="<?= e($val('icon_class')) ?>" placeholder="fab fa-github">
                </div>
                <div class="form-group form-full">
                    <label for="url">URL</label>
                    <input type="url" id="url" name="url" value="<?= e($val('url')) ?>" placeholder="https://...">
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= e(adminUrl('contacts/index.php')) ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
