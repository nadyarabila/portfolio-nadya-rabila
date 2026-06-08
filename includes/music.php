<?php

declare(strict_types=1);

function getAllMusicTracks(): array
{
    $pdo = getDBConnection();
    $stmt = $pdo->query('SELECT * FROM music_tracks ORDER BY id ASC');

    return $stmt->fetchAll();
}

function getMusicTrackById(int $id): ?array
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare('SELECT * FROM music_tracks WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);

    $row = $stmt->fetch();

    return $row ?: null;
}

function createMusicTrack(array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'INSERT INTO music_tracks (title, artist, audio_file, cover_image) 
         VALUES (:title, :artist, :audio_file, :cover_image)'
    );

    return $stmt->execute([
        ':title'       => $data['title'],
        ':artist'      => $data['artist'],
        ':audio_file'  => $data['audio_file'],
        ':cover_image' => $data['cover_image'],
    ]);
}

function updateMusicTrack(int $id, array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'UPDATE music_tracks SET 
            title = :title, 
            artist = :artist, 
            audio_file = :audio_file, 
            cover_image = :cover_image 
         WHERE id = :id'
    );

    return $stmt->execute([
        ':title'       => $data['title'],
        ':artist'      => $data['artist'],
        ':audio_file'  => $data['audio_file'],
        ':cover_image' => $data['cover_image'],
        ':id'          => $id,
    ]);
}

function deleteMusicTrack(int $id): bool
{
    $item = getMusicTrackById($id);
    if (!$item) {
        return false;
    }

    $pdo = getDBConnection();
    $stmt = $pdo->prepare('DELETE FROM music_tracks WHERE id = ?');

    if ($stmt->execute([$id])) {
        // Only delete if it's in uploads/
        if (str_starts_with((string)$item['audio_file'], 'uploads/')) {
            deleteUploadedImage($item['audio_file']);
        }
        if ($item['cover_image'] && str_starts_with((string)$item['cover_image'], 'uploads/')) {
            deleteUploadedImage($item['cover_image']);
        }
        return true;
    }

    return false;
}

function validateMusicInput(array $post, array $audioFile, array $coverFile, bool $isEdit, ?array $current = null): array
{
    $errors = [];
    $title = trim((string) ($post['title'] ?? ''));
    $artist = trim((string) ($post['artist'] ?? ''));

    if ($title === '') $errors[] = 'Judul lagu wajib diisi.';
    if ($artist === '') $errors[] = 'Nama artist wajib diisi.';

    $audioPath = $current['audio_file'] ?? '';
    if (($audioFile['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
        $audioVal = validateAudioUpload($audioFile, true);
        if (!$audioVal['ok']) {
            $errors[] = $audioVal['message'];
        }
    } elseif (!$isEdit) {
        $errors[] = 'File audio wajib diunggah.';
    }

    $coverPath = $current['cover_image'] ?? null;
    if (($coverFile['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
        $coverVal = validateImageUpload($coverFile, false);
        if (!$coverVal['ok']) {
            $errors[] = $coverVal['message'];
        }
    }

    return [
        'ok' => $errors === [],
        'data' => [
            'title' => $title,
            'artist' => $artist,
        ],
        'errors' => $errors
    ];
}
