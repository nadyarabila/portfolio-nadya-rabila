<?php

/** @var string $currentImage */
/** @var bool $isEdit */
/** @var bool $required */
$currentImage = $currentImage ?? '';
$isEdit = $isEdit ?? false;
$required = $required ?? true;
$inputId = $inputId ?? 'image';
$previewId = $previewId ?? 'imagePreview';
?>
<div class="form-group form-full">
    <label for="<?= e($inputId) ?>">
        Gambar <?= $isEdit && !$required ? '(kosongkan jika tidak diganti)' : '' ?>
        <?php if ($required && !$isEdit): ?><span class="required">*</span><?php endif; ?>
        <span class="hint">JPG, PNG, WEBP · maks 2MB</span>
    </label>
    <input type="file" id="<?= e($inputId) ?>" name="image" accept=".jpg,.jpeg,.png,.webp"
           class="image-upload-input" data-preview="<?= e($previewId) ?>"
           <?= ($required && !$isEdit) ? 'required' : '' ?>>
</div>

<div class="form-group form-full">
    <label>Preview Gambar</label>
    <div class="image-preview-box">
        <?php if ($currentImage !== ''): ?>
            <div style="text-align: center;">
                <img src="<?= e('../../' . ltrim($currentImage, '/')) ?>" alt="Preview" id="<?= e($previewId) ?>"
                     class="image-preview">
                <div style="margin-top: 10px;">
                    <a href="<?= e('../../' . ltrim($currentImage, '/')) ?>" target="_blank" class="btn btn-sm btn-secondary">
                        <i class="fas fa-eye"></i> Lihat Full Gambar
                    </a>
                </div>
            </div>
        <?php else: ?>
            <img src="" alt="Preview" id="<?= e($previewId) ?>" class="image-preview" style="display:none;">
            <p class="preview-placeholder" id="previewPlaceholder">Belum ada gambar</p>
        <?php endif; ?>
    </div>
</div>
