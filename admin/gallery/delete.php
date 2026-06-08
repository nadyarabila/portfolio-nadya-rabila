<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . adminUrl('gallery/index.php'));
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
if ($id > 0 && deleteGalleryItem($id)) {
    setFlash('success', 'Foto galeri berhasil dihapus.');
} else {
    setFlash('error', 'Gagal menghapus foto galeri.');
}

header('Location: ' . adminUrl('gallery/index.php'));
exit;
