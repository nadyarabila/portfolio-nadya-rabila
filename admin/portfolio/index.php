<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';

requireAdminLogin();

$pageTitle = 'Kelola Portofolio';
$activePage = 'portfolio';

$page = max(1, (int) ($_GET['page'] ?? 1));
$result = getPortfoliosPaginated($page);
$items = $result['items'];

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="page-actions">
    <a href="<?= e(adminUrl('portfolio/create.php')) ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Portofolio
    </a>
</div>

<div class="panel-card">
    <div class="panel-header panel-header-flex">
        <h2><i class="fas fa-briefcase"></i> Daftar Portofolio</h2>
        <span class="badge-count"><?= (int) $result['total'] ?> item</span>
    </div>
    <div class="panel-body table-responsive">
        <?php if ($items === []): ?>
            <p class="text-muted">Belum ada data portofolio. <a href="<?= e(adminUrl('portfolio/create.php')) ?>">Tambah sekarang</a>.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Tech Stack</th>
                        <th>Link</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <img src="<?= e('../../' . ltrim((string) $item['image'], '/')) ?>"
                                     alt="<?= e((string) $item['title']) ?>" class="table-thumb">
                            </td>
                            <td><?= e((string) $item['title']) ?></td>
                            <td class="text-muted small"><?= e((string) $item['tech_stack']) ?></td>
                            <td class="small">
                                <?php if (!empty($item['project_link'])): ?>
                                    <a href="<?= e((string) $item['project_link']) ?>" target="_blank" rel="noopener">Buka</a>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td class="small"><?= e(formatDateId((string) $item['created_at'])) ?></td>
                            <td class="table-actions">
                                <a href="<?= e(adminUrl('portfolio/edit.php?id=' . (int) $item['id'])) ?>"
                                   class="btn btn-sm btn-secondary" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="post" action="<?= e(adminUrl('portfolio/delete.php')) ?>"
                                      class="inline-form"
                                      onsubmit="return confirm('Hapus portofolio ini?');">
                                    <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if ($result['total_pages'] > 1): ?>
                <nav class="pagination" aria-label="Paginasi portofolio">
                    <?php if ($result['page'] > 1): ?>
                        <a href="?page=<?= $result['page'] - 1 ?>" class="page-link">&laquo; Sebelumnya</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $result['total_pages']; $i++): ?>
                        <a href="?page=<?= $i ?>"
                           class="page-link <?= $i === $result['page'] ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($result['page'] < $result['total_pages']): ?>
                        <a href="?page=<?= $result['page'] + 1 ?>" class="page-link">Selanjutnya &raquo;</a>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
