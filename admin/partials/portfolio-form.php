<?php

/** @var array<string, mixed>|null $portfolio */
/** @var bool $isEdit */
$portfolio = $portfolio ?? null;
$isEdit = $isEdit ?? false;
$errors = $errors ?? [];
$old = $old ?? [];

$value = static function (string $key) use ($portfolio, $old): string {
    if (array_key_exists($key, $old)) {
        return (string) $old[$key];
    }
    return (string) ($portfolio[$key] ?? '');
};

$currentImage = $value('image');
?>
<?php if ($errors !== []): ?>
    <div class="alert alert-error" role="alert">
        <i class="fas fa-circle-exclamation"></i>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="admin-form">
    <div class="form-grid">
        <div class="form-group">
            <label for="title">Judul Proyek <span class="required">*</span></label>
            <input type="text" id="title" name="title" value="<?= e($value('title')) ?>" required>
        </div>

        <div class="form-group">
            <label for="project_link">Link Proyek (opsional)</label>
            <input type="url" id="project_link" name="project_link" value="<?= e($value('project_link')) ?>"
                   placeholder="https://...">
        </div>

        <div class="form-group form-full">
            <label for="description">Deskripsi <span class="required">*</span></label>
            <textarea id="description" name="description" rows="4" required><?= e($value('description')) ?></textarea>
        </div>

        <div class="form-group form-full">
            <label for="tech_stack">Tech Stack <span class="hint">(pisahkan dengan koma)</span></label>
            <input type="text" id="tech_stack" name="tech_stack" value="<?= e($value('tech_stack')) ?>"
                   placeholder="PHP, HTML, CSS, JavaScript">
        </div>

        <div class="form-group form-full">
            <label for="image">
                Gambar <?= $isEdit ? '' : '<span class="required">*</span>' ?>
                <span class="hint">JPG, PNG, WEBP · maks 2MB</span>
            </label>
            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp"
                   class="image-upload-input" data-preview="imagePreview"
                   <?= $isEdit ? '' : 'required' ?>>
        </div>

        <div class="form-group form-full">
            <label>Preview Gambar</label>
            <div class="image-preview-box" id="imagePreviewBox">
                <?php if ($currentImage !== ''): ?>
                    <div style="text-align: center;">
                        <img src="<?= e('../../' . ltrim($currentImage, '/')) ?>" alt="Preview" id="imagePreview"
                             class="image-preview">
                        <div style="margin-top: 10px;">
                            <a href="<?= e('../../' . ltrim($currentImage, '/')) ?>" target="_blank" class="btn btn-sm btn-secondary">
                                <i class="fas fa-eye"></i> Lihat Full Gambar
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <img src="" alt="Preview" id="imagePreview" class="image-preview" style="display:none;">
                    <p class="preview-placeholder" id="previewPlaceholder">Belum ada gambar</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="<?= e(adminUrl('portfolio/index.php')) ?>" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Portofolio' ?>
        </button>
    </div>
</form>
