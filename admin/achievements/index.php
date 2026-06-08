<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Kelola Prestasi';
$activePage = 'achievements';
$page = max(1, (int) ($_GET['page'] ?? 1));
$result = getAchievementsPaginated($page);

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="page-actions">
    <a href="<?= e(adminUrl('achievements/create.php')) ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Prestasi
    </a>
</div>

<div class="panel-card">
    <div class="panel-header panel-header-flex">
        <h2><i class="fas fa-trophy"></i> Daftar Prestasi</h2>
        <span class="badge-count"><?= (int) $result['total'] ?> item</span>
    </div>
    <div class="panel-body table-responsive">
        <?php if ($result['items'] === []): ?>
            <p class="text-muted">Belum ada data.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr><th>Gambar</th><th>Judul</th><th>Tahun</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($result['items'] as $item): ?>
                    <tr>
                        <td><img src="<?= e('../../' . ltrim((string) $item['image'], '/')) ?>" alt="" class="table-thumb"></td>
                        <td><?= e((string) $item['title']) ?></td>
                        <td><?= e((string) $item['year']) ?></td>
                        <td class="table-actions">
                            <a href="<?= e(adminUrl('achievements/edit.php?id=' . (int) $item['id'])) ?>" class="btn btn-sm btn-secondary"><i class="fas fa-pen"></i></a>
                            <form method="post" action="<?= e(adminUrl('achievements/delete.php')) ?>" class="inline-form" onsubmit="return confirm('Hapus prestasi ini?');">
                                <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php require dirname(__DIR__) . '/partials/pagination-nav.php'; ?>
        <?php endif; ?>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
