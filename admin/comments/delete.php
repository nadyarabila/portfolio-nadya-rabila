<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    if (deleteComment($id)) {
        setFlash('success', 'Komentar berhasil dihapus.');
    } else {
        setFlash('error', 'Gagal menghapus komentar.');
    }
}

header('Location: ' . adminUrl('comments/index.php'));
exit;
