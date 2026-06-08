<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Kelola Komentar Pengunjung';
$activePage = 'comments';
$comments = getAllComments();

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="panel-card">
    <div class="panel-header panel-header-flex">
        <h2><i class="fas fa-comments"></i> Komentar Pengunjung</h2>
        <span class="badge-count"><?= count($comments) ?> item</span>
    </div>
    <div class="panel-body table-responsive">
        <?php if ($comments === []): ?>
            <p class="text-muted">Belum ada komentar dari pengunjung.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 150px;">Nama</th>
                        <th>Komentar</th>
                        <th style="width: 150px;">Tanggal</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?= (int) $comment['id'] ?></td>
                        <td><strong><?= e((string) $comment['nama']) ?></strong></td>
                        <td><?= nl2br(e((string) $comment['komentar'])) ?></td>
                        <td><small><?= date('d M Y, H:i', strtotime((string) $comment['created_at'])) ?></small></td>
                        <td class="table-actions">
                            <a href="<?= e(adminUrl('comments/delete.php?id=' . (int) $comment['id'])) ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
