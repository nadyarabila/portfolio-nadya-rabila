<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    
    if (deleteMusicTrack($id)) {
        setFlash('success', 'Lagu berhasil dihapus dari playlist.');
    } else {
        setFlash('error', 'Gagal menghapus lagu.');
    }
}

header('Location: ' . adminUrl('music/index.php'));
exit;
