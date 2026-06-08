<?php

declare(strict_types=1);

function getAllContacts(): array
{
    $pdo = getDBConnection();
    $stmt = $pdo->query('SELECT * FROM contacts ORDER BY id ASC');

    return $stmt->fetchAll();
}

function getContactById(int $id): ?array
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);

    $row = $stmt->fetch();

    return $row ?: null;
}

function updateContact(int $id, array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'UPDATE contacts SET
            platform = :platform,
            label = :label,
            username = :username,
            url = :url,
            icon_class = :icon_class
         WHERE id = :id'
    );

    return $stmt->execute([
        ':platform'   => $data['platform'],
        ':label'      => $data['label'],
        ':username'   => $data['username'],
        ':url'        => $data['url'],
        ':icon_class' => $data['icon_class'],
        ':id'         => $id,
    ]);
}

function validateContactInput(array $post): array
{
    $errors = [];
    $platform = trim((string) ($post['platform'] ?? ''));
    $label = trim((string) ($post['label'] ?? ''));
    $username = trim((string) ($post['username'] ?? ''));
    $url = trim((string) ($post['url'] ?? ''));
    $icon_class = trim((string) ($post['icon_class'] ?? ''));

    if ($platform === '') {
        $errors[] = 'Platform wajib diisi.';
    }
    if ($label === '') {
        $errors[] = 'Label wajib diisi.';
    }
    if ($username === '') {
        $errors[] = 'Username wajib diisi.';
    }

    return [
        'ok'     => $errors === [],
        'data'   => [
            'platform'   => $platform,
            'label'      => $label,
            'username'   => $username,
            'url'        => $url,
            'icon_class' => $icon_class,
        ],
        'errors' => $errors,
    ];
}
