<?php

declare(strict_types=1);

require_once __DIR__ . '/image-field.php';

const ACHIEVEMENTS_PER_PAGE = 5;

function getPublicAchievements(): array
{
    $pdo = getDBConnection();
    $stmt = $pdo->query('SELECT * FROM achievements ORDER BY id ASC');

    return $stmt->fetchAll();
}

function getAchievementsPaginated(int $page = 1, int $perPage = ACHIEVEMENTS_PER_PAGE): array
{
    return paginateTable('achievements', $page, $perPage);
}

function getAchievementById(int $id): ?array
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare('SELECT * FROM achievements WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);

    $row = $stmt->fetch();

    return $row ?: null;
}

function createAchievement(array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'INSERT INTO achievements (title, year, description, image)
         VALUES (:title, :year, :description, :image)'
    );

    return $stmt->execute([
        ':title'       => $data['title'],
        ':year'        => $data['year'],
        ':description' => $data['description'],
        ':image'       => $data['image'],
    ]);
}

function updateAchievement(int $id, array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'UPDATE achievements SET
            title = :title,
            year = :year,
            description = :description,
            image = :image
         WHERE id = :id'
    );

    return $stmt->execute([
        ':title'       => $data['title'],
        ':year'        => $data['year'],
        ':description' => $data['description'],
        ':image'       => $data['image'],
        ':id'          => $id,
    ]);
}

function deleteAchievement(int $id): bool
{
    $item = getAchievementById($id);
    if (!$item) {
        return false;
    }

    $pdo = getDBConnection();
    $stmt = $pdo->prepare('DELETE FROM achievements WHERE id = ?');

    if ($stmt->execute([$id])) {
        deleteUploadedImage($item['image'] ?? null);
        return true;
    }

    return false;
}

function validateAchievementInput(array $post, ?array $file, bool $isEdit, ?string $currentImage): array
{
    $errors = [];
    $title = trim((string) ($post['title'] ?? ''));
    $year = trim((string) ($post['year'] ?? ''));
    $description = trim((string) ($post['description'] ?? ''));

    if ($title === '') {
        $errors[] = 'Judul wajib diisi.';
    }

    if ($year === '') {
        $errors[] = 'Tahun wajib diisi.';
    }

    if ($description === '') {
        $errors[] = 'Deskripsi wajib diisi.';
    }

    $image = resolveImagePathFromUpload($file ?? [], 'achievements', $isEdit, $currentImage, true);
    $errors = array_merge($errors, $image['errors']);

    return [
        'ok'     => $errors === [],
        'data'   => [
            'title'       => $title,
            'year'        => $year,
            'description' => $description,
            'image'       => $image['path'],
        ],
        'errors' => $errors,
    ];
}

function imagePathToAlt(string $path): string
{
    $name = pathinfo($path, PATHINFO_FILENAME);

    return trim(str_replace(['_', '-'], ' ', $name));
}
