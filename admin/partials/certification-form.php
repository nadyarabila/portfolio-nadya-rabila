<?php

/** @var array<string, mixed>|null $item */
/** @var bool $isEdit */
/** @var list<string> $errors */
/** @var array<string, string> $old */
$item = $item ?? null;
$isEdit = $isEdit ?? false;
$errors = $errors ?? [];
$old = $old ?? [];

$val = static function (string $key) use ($item, $old): string {
    if (array_key_exists($key, $old)) {
        return (string) $old[$key];
    }
    return (string) ($item[$key] ?? '');
};
?>
<?php if ($errors !== []): ?>
<div class="alert alert-error" role="alert">
    <i class="fas fa-circle-exclamation"></i>
    <ul class="error-list"><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul>
</div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="admin-form">
    <div class="form-grid">
        <div class="form-group form-full">
            <label for="title">Judul <span class="required">*</span></label>
            <input type="text" id="title" name="title" value="<?= e($val('title')) ?>" required>
        </div>
        <div class="form-group form-full">
            <label for="description">Deskripsi <span class="required">*</span></label>
            <textarea id="description" name="description" rows="4" required><?= e($val('description')) ?></textarea>
            <span class="hint">Baris baru akan ditampilkan sebagai baris terpisah di website.</span>
        </div>
        <?php
        $currentImage = $val('image');
        require __DIR__ . '/image-upload-field.php';
        ?>
    </div>
    <div class="form-actions">
        <a href="<?= e(adminUrl('certifications/index.php')) ?>" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    </div>
</form>
