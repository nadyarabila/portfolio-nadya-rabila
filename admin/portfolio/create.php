<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';

requireAdminLogin();

$pageTitle = 'Tambah Portofolio';
$activePage = 'portfolio';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['image'] ?? [];
    $validated = validatePortfolioInput($_POST, $file, false, null);

    if ($validated['ok']) {
        if (createPortfolio($validated['data'])) {
            setFlash('success', 'Portofolio berhasil ditambahkan.');
            header('Location: ' . adminUrl('portfolio/index.php'));
            exit;
        }
        $errors[] = 'Gagal menyimpan ke database.';
    } else {
        $errors = $validated['errors'];
        $old = $validated['data'];
    }
}

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="panel-card">
    <div class="panel-header">
        <h2><i class="fas fa-plus"></i> Tambah Portofolio Baru</h2>
    </div>
    <div class="panel-body">
        <?php
        $isEdit = false;
        $portfolio = null;
        require dirname(__DIR__) . '/partials/portfolio-form.php';
        ?>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
