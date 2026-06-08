<?php

declare(strict_types=1);

function getAllComments(): array
{
    $db = getDBConnection();
    $stmt = $db->query("SELECT * FROM comments ORDER BY created_at DESC");
    return $stmt->fetchAll();
}

function getCommentCount(): int
{
    $db = getDBConnection();
    $stmt = $db->query("SELECT COUNT(*) FROM comments");
    return (int) $stmt->fetchColumn();
}

function addComment(string $nama, string $komentar): bool
{
    $db = getDBConnection();
    $stmt = $db->prepare("INSERT INTO comments (nama, komentar) VALUES (:nama, :komentar)");
    return $stmt->execute([
        'nama' => $nama,
        'komentar' => $komentar
    ]);
}

function deleteComment(int $id): bool
{
    $db = getDBConnection();
    $stmt = $db->prepare("DELETE FROM comments WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
