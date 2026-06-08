<?php

declare(strict_types=1);

require_once __DIR__ . '/image-field.php';

const CERTIFICATIONS_PER_PAGE = 5;

function getPublicCertifications(): array
{
    $pdo = getDBConnection();
    $stmt = $pdo->query('SELECT * FROM certifications ORDER BY id ASC');

    return $stmt->fetchAll();
}

function getCertificationsPaginated(int $page = 1, int $perPage = CERTIFICATIONS_PER_PAGE): array
{
    return paginateTable('certifications', $page, $perPage);
}

function getCertificationById(int $id): ?array
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare('SELECT * FROM certifications WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);

    $row = $stmt->fetch();

    return $row ?: null;
}

function createCertification(array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'INSERT INTO certifications (title, description, image) VALUES (:title, :description, :image)'
    );

    return $stmt->execute([
        ':title'       => $data['title'],
        ':description' => $data['description'],
        ':image'       => $data['image'],
    ]);
}

function updateCertification(int $id, array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'UPDATE certifications SET title = :title, description = :description, image = :image WHERE id = :id'
    );

    return $stmt->execute([
        ':title'       => $data['title'],
        ':description' => $data['description'],
        ':image'       => $data['image'],
        ':id'          => $id,
    ]);
}

function deleteCertification(int $id): bool
{
    $item = getCertificationById($id);
    if (!$item) {
        return false;
    }

    $pdo = getDBConnection();
    $stmt = $pdo->prepare('DELETE FROM certifications WHERE id = ?');

    if ($stmt->execute([$id])) {
        deleteUploadedImage($item['image'] ?? null);
        return true;
    }

    return false;
}

function validateCertificationInput(array $post, ?array $file, bool $isEdit, ?string $currentImage): array
{
    $errors = [];
    $title = trim((string) ($post['title'] ?? ''));
    $description = trim((string) ($post['description'] ?? ''));

    if ($title === '') {
        $errors[] = 'Judul wajib diisi.';
    }

    if ($description === '') {
        $errors[] = 'Deskripsi wajib diisi.';
    }

    $image = resolveImagePathFromUpload($file ?? [], 'certifications', $isEdit, $currentImage, true);
    $errors = array_merge($errors, $image['errors']);

    return [
        'ok'     => $errors === [],
        'data'   => [
            'title'       => $title,
            'description' => $description,
            'image'       => $image['path'],
        ],
        'errors' => $errors,
    ];
}
