<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . adminUrl('certifications/index.php'));
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
if ($id > 0 && deleteCertification($id)) {
    setFlash('success', 'Sertifikat berhasil dihapus.');
} else {
    setFlash('error', 'Gagal menghapus sertifikat.');
}

header('Location: ' . adminUrl('certifications/index.php'));
exit;
