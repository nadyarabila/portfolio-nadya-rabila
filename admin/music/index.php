<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Kelola Musik';
$activePage = 'music';
$tracks = getAllMusicTracks();

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="page-actions">
    <a href="<?= e(adminUrl('music/create.php')) ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Lagu
    </a>
</div>

<div class="panel-card">
    <div class="panel-header panel-header-flex">
        <h2><i class="fas fa-music"></i> Playlist Musik</h2>
        <span class="badge-count"><?= count($tracks) ?> lagu</span>
    </div>
    <div class="panel-body table-responsive">
        <?php if ($tracks === []): ?>
            <p class="text-muted">Belum ada lagu di playlist.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Artist</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tracks as $track): ?>
                    <tr>
                        <td>
                            <?php if ($track['cover_image']): ?>
                                <img src="<?= e('../../' . ltrim((string)$track['cover_image'], '/')) ?>" alt="" class="table-thumb">
                            <?php else: ?>
                                <div class="table-thumb" style="display:flex;align-items:center;justify-content:center;background:var(--admin-bg-alt);">
                                    <i class="fas fa-music text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><strong><?= e((string)$track['title']) ?></strong></td>
                        <td><?= e((string)$track['artist']) ?></td>
                        <td class="small"><code><?= basename((string)$track['audio_file']) ?></code></td>
                        <td class="table-actions">
                            <a href="<?= e(adminUrl('music/edit.php?id=' . (int)$track['id'])) ?>" class="btn btn-sm btn-secondary">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="post" action="<?= e(adminUrl('music/delete.php')) ?>" class="inline-form" onsubmit="return confirm('Hapus lagu ini?');">
                                <input type="hidden" name="id" value="<?= (int)$track['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
