<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Kelola Galeri';
$activePage = 'gallery';
$page = max(1, (int) ($_GET['page'] ?? 1));
$result = getGalleryPaginated($page);

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="page-actions">
    <a href="<?= e(adminUrl('gallery/create.php')) ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Upload Foto Galeri
    </a>
</div>

<div class="panel-card">
    <div class="panel-header panel-header-flex">
        <h2><i class="fas fa-images"></i> Daftar Galeri</h2>
        <span class="badge-count"><?= (int) $result['total'] ?> foto</span>
    </div>
    <div class="panel-body">
        <?php if ($result['items'] === []): ?>
            <p class="text-muted">Belum ada foto galeri.</p>
        <?php else: ?>
            <div class="gallery-admin-grid">
                <?php foreach ($result['items'] as $item): ?>
                <div class="gallery-admin-card">
                    <img src="<?= e('../../' . ltrim((string) $item['image'], '/')) ?>" alt="">
                    <div class="gallery-admin-actions">
                        <a href="<?= e(adminUrl('gallery/edit.php?id=' . (int) $item['id'])) ?>" class="btn btn-sm btn-secondary"><i class="fas fa-pen"></i></a>
                        <form method="post" action="<?= e(adminUrl('gallery/delete.php')) ?>" class="inline-form" onsubmit="return confirm('Hapus foto ini?');">
                            <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php require dirname(__DIR__) . '/partials/pagination-nav.php'; ?>
        <?php endif; ?>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
