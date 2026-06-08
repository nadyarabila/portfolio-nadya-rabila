<?php

declare(strict_types=1);

require_once __DIR__ . '/image-field.php';

const GALLERY_PER_PAGE = 8;

function getPublicGalleryItems(): array
{
    $pdo = getDBConnection();
    $stmt = $pdo->query('SELECT * FROM gallery ORDER BY id ASC');

    return $stmt->fetchAll();
}

function getGalleryPaginated(int $page = 1, int $perPage = GALLERY_PER_PAGE): array
{
    return paginateTable('gallery', $page, $perPage);
}

function getGalleryItemById(int $id): ?array
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare('SELECT * FROM gallery WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);

    $row = $stmt->fetch();

    return $row ?: null;
}

function createGalleryItem(array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare('INSERT INTO gallery (image) VALUES (:image)');

    return $stmt->execute([':image' => $data['image']]);
}

function updateGalleryItem(int $id, array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare('UPDATE gallery SET image = :image WHERE id = :id');

    return $stmt->execute([
        ':image' => $data['image'],
        ':id'    => $id,
    ]);
}

function deleteGalleryItem(int $id): bool
{
    $item = getGalleryItemById($id);
    if (!$item) {
        return false;
    }

    $pdo = getDBConnection();
    $stmt = $pdo->prepare('DELETE FROM gallery WHERE id = ?');

    if ($stmt->execute([$id])) {
        deleteUploadedImage($item['image'] ?? null);
        return true;
    }

    return false;
}

function validateGalleryInput(array $post, ?array $file, bool $isEdit, ?string $currentImage): array
{
    $errors = [];
    $image = resolveImagePathFromUpload($file ?? [], 'gallery', $isEdit, $currentImage, true);
    $errors = array_merge($errors, $image['errors']);

    return [
        'ok'     => $errors === [],
        'data'   => ['image' => $image['path']],
        'errors' => $errors,
    ];
}
