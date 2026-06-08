<?php

declare(strict_types=1);

/**
 * @return array{path: string, errors: list<string>}
 */
function resolveImagePathFromUpload(
    array $file,
    string $uploadType,
    bool $isEdit,
    ?string $currentImage,
    bool $required = true
): array {
    $errors = [];
    $imagePath = $currentImage ?? '';
    $hasUpload = isset($file['error']) && $file['error'] !== UPLOAD_ERR_NO_FILE;

    if ($hasUpload) {
        $validation = validateImageUpload($file, false);
        if (!$validation['ok']) {
            $errors[] = $validation['message'];
        } else {
            $saved = saveUploadedImage($file, $uploadType);
            if (!$saved['ok']) {
                $errors[] = $saved['message'];
            } else {
                $imagePath = $saved['path'];
            }
        }
    } elseif ($required && (!$isEdit || $imagePath === '')) {
        $errors[] = 'Gambar wajib diunggah.';
    }

    return ['path' => $imagePath, 'errors' => $errors];
}
