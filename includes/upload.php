<?php

declare(strict_types=1);

/**
 * @return array{ok: bool, message: string}
 */
function validateImageUpload(array $file, bool $required = true): array
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        if ($required) {
            return ['ok' => false, 'message' => 'Gambar wajib diunggah.'];
        }

        return ['ok' => true, 'message' => ''];
    }

    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'message' => 'Gagal mengunggah file. Coba lagi.'];
    }

    if (($file['size'] ?? 0) > UPLOAD_MAX_BYTES) {
        return ['ok' => false, 'message' => 'Ukuran file maksimal 2MB.'];
    }

    $originalName = (string) ($file['name'] ?? '');
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($extension, UPLOAD_ALLOWED_EXTENSIONS, true)) {
        return ['ok' => false, 'message' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.'];
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name'] ?? '') ?: '';
    $allowedMimes = [
        'jpg'  => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
        'png'  => ['image/png'],
        'webp' => ['image/webp'],
    ];

    if (!isset($allowedMimes[$extension]) || !in_array($mime, $allowedMimes[$extension], true)) {
        return ['ok' => false, 'message' => 'Tipe file tidak valid atau tidak sesuai ekstensi.'];
    }

    return ['ok' => true, 'message' => ''];
    }

    function validateAudioUpload(array $file, bool $required = true): array
    {
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        if ($required) {
            return ['ok' => false, 'message' => 'File audio wajib diunggah.'];
        }
        return ['ok' => true, 'message' => ''];
    }

    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'message' => 'Gagal mengunggah file audio.'];
    }

    if (($file['size'] ?? 0) > UPLOAD_MAX_AUDIO_BYTES) {
        return ['ok' => false, 'message' => 'Ukuran file audio maksimal 10MB.'];
    }

    $extension = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, UPLOAD_ALLOWED_AUDIO, true)) {
        return ['ok' => false, 'message' => 'Format audio harus MP3, WAV, atau OGG.'];
    }

    return ['ok' => true, 'message' => ''];
    }

    function saveUploadedAudio(array $file): array
    {
    $validation = validateAudioUpload($file, true);
    if (!$validation['ok']) {
        return ['ok' => false, 'path' => '', 'message' => $validation['message']];
    }

    $extension = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
    $filename = 'music_' . bin2hex(random_bytes(8)) . '_' . time() . '.' . $extension;
    $destinationDir = UPLOAD_SUBDIRS['music'];
    $destination = $destinationDir . DIRECTORY_SEPARATOR . $filename;

    if (!is_dir($destinationDir) && !mkdir($destinationDir, 0755, true) && !is_dir($destinationDir)) {
        return ['ok' => false, 'path' => '', 'message' => 'Folder music tidak dapat dibuat.'];
    }

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return ['ok' => false, 'path' => '', 'message' => 'Gagal menyimpan file audio.'];
    }

    $relativePath = UPLOAD_URL_BASE . '/music/' . $filename;
    return ['ok' => true, 'path' => $relativePath, 'message' => 'Upload audio berhasil.'];
    }

    /**
     * @return array{ok: bool, path: string, message: string}
     */
    function saveUploadedImage(array $file, string $type, bool $required = true): array
    {
        $validation = validateImageUpload($file, $required);
        if (!$validation['ok']) {
            return ['ok' => false, 'path' => '', 'message' => $validation['message']];
        }

    $extension = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
    $filename = $type . '_' . bin2hex(random_bytes(8)) . '_' . time() . '.' . $extension;
    $destinationDir = uploadPath($type);
    $destination = $destinationDir . DIRECTORY_SEPARATOR . $filename;

    if (!is_dir($destinationDir) && !mkdir($destinationDir, 0755, true) && !is_dir($destinationDir)) {
        return ['ok' => false, 'path' => '', 'message' => 'Folder upload tidak dapat dibuat.'];
    }

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return ['ok' => false, 'path' => '', 'message' => 'Gagal menyimpan file upload.'];
    }

    $relativePath = UPLOAD_URL_BASE . '/' . $type . '/' . $filename;

    return ['ok' => true, 'path' => $relativePath, 'message' => 'Upload berhasil.'];
}

function deleteUploadedImage(?string $relativePath): void
{
    if ($relativePath === null || $relativePath === '') {
        return;
    }

    $normalized = str_replace('\\', '/', $relativePath);
    if (!str_starts_with($normalized, UPLOAD_URL_BASE . '/')) {
        return;
    }

    $fullPath = APP_ROOT . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $normalized);

    if (is_file($fullPath)) {
        unlink($fullPath);
    }
}
