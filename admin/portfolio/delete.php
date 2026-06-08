<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';

requireAdminLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . adminUrl('portfolio/index.php'));
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    setFlash('error', 'ID portofolio tidak valid.');
} elseif (deletePortfolio($id)) {
    setFlash('success', 'Portofolio berhasil dihapus.');
} else {
    setFlash('error', 'Gagal menghapus portofolio.');
}

header('Location: ' . adminUrl('portfolio/index.php'));
exit;
