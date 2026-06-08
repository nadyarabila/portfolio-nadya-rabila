<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';

requireAdminLogin();

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$portfolio = getPortfolioById($id);

if (!$portfolio) {
    setFlash('error', 'Data portofolio tidak ditemukan.');
    header('Location: ' . adminUrl('portfolio/index.php'));
    exit;
}

$pageTitle = 'Edit Portofolio';
$activePage = 'portfolio';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['image'] ?? [];
    $validated = validatePortfolioInput($_POST, $file, true, (string) $portfolio['image']);

    if ($validated['ok']) {
        $newImage = $validated['data']['image'];
        if ($newImage !== $portfolio['image']) {
            deleteUploadedImage((string) $portfolio['image']);
        }

        if (updatePortfolio($id, $validated['data'])) {
            setFlash('success', 'Portofolio berhasil diperbarui.');
            header('Location: ' . adminUrl('portfolio/index.php'));
            exit;
        }
        $errors[] = 'Gagal memperbarui database.';
    } else {
        $errors = $validated['errors'];
        $old = $validated['data'];
    }

    $portfolio = array_merge($portfolio, $old);
}

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="panel-card">
    <div class="panel-header">
        <h2><i class="fas fa-pen"></i> Edit Portofolio</h2>
    </div>
    <div class="panel-body">
        <?php
        $isEdit = true;
        require dirname(__DIR__) . '/partials/portfolio-form.php';
        ?>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
