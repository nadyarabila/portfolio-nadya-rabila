<?php

/** @var array<string, mixed>|null $item */
/** @var bool $isEdit */
/** @var list<string> $errors */
/** @var array<string, string> $old */
$item = $item ?? null;
$isEdit = $isEdit ?? false;
$errors = $errors ?? [];
$old = $old ?? [];

$currentImage = array_key_exists('image', $old) ? (string) $old['image'] : (string) ($item['image'] ?? '');
?>
<?php if ($errors !== []): ?>
<div class="alert alert-error" role="alert">
    <i class="fas fa-circle-exclamation"></i>
    <ul class="error-list"><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul>
</div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="admin-form">
    <div class="form-grid">
        <?php require __DIR__ . '/image-upload-field.php'; ?>
    </div>
    <div class="form-actions">
        <a href="<?= e(adminUrl('gallery/index.php')) ?>" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    </div>
</form>
