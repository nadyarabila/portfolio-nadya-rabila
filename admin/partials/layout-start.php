<?php

/** @var string $pageTitle */
/** @var string $activePage */
$pageTitle = $pageTitle ?? 'Dashboard';
$activePage = $activePage ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> — Admin <?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= e(adminAsset('css/admin.css')) ?>">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <?php require __DIR__ . '/sidebar.php'; ?>

        <div class="admin-main">
            <header class="admin-topbar">
                <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Buka menu">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="topbar-title">
                    <h1><?= e($pageTitle) ?></h1>
                    <p>Selamat datang, <strong><?= e(currentAdminUsername()) ?></strong></p>
                </div>
            </header>

            <main class="admin-content">
                <?php require __DIR__ . '/flash-messages.php'; ?>
