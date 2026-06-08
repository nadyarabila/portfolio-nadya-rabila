<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . adminUrl('achievements/index.php'));
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
if ($id > 0 && deleteAchievement($id)) {
    setFlash('success', 'Prestasi berhasil dihapus.');
} else {
    setFlash('error', 'Gagal menghapus prestasi.');
}

header('Location: ' . adminUrl('achievements/index.php'));
exit;
