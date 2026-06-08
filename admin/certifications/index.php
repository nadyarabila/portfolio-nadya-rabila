<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Kelola Sertifikat';
$activePage = 'certifications';
$page = max(1, (int) ($_GET['page'] ?? 1));
$result = getCertificationsPaginated($page);

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="page-actions">
    <a href="<?= e(adminUrl('certifications/create.php')) ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Sertifikat
    </a>
</div>

<div class="panel-card">
    <div class="panel-header panel-header-flex">
        <h2><i class="fas fa-certificate"></i> Daftar Sertifikat</h2>
        <span class="badge-count"><?= (int) $result['total'] ?> item</span>
    </div>
    <div class="panel-body table-responsive">
        <?php if ($result['items'] === []): ?>
            <p class="text-muted">Belum ada data.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr><th>Gambar</th><th>Judul</th><th>Deskripsi</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($result['items'] as $item): ?>
                    <tr>
                        <td><img src="<?= e('../../' . ltrim((string) $item['image'], '/')) ?>" alt="" class="table-thumb"></td>
                        <td><?= e((string) $item['title']) ?></td>
                        <td class="small text-muted"><?php $d = (string) $item['description']; echo e(strlen($d) > 80 ? substr($d, 0, 80) . '…' : $d); ?></td>
                        <td class="table-actions">
                            <a href="<?= e(adminUrl('certifications/edit.php?id=' . (int) $item['id'])) ?>" class="btn btn-sm btn-secondary"><i class="fas fa-pen"></i></a>
                            <form method="post" action="<?= e(adminUrl('certifications/delete.php')) ?>" class="inline-form" onsubmit="return confirm('Hapus sertifikat ini?');">
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
