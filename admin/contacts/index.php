<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Kelola Kontak';
$activePage = 'contacts';
$contacts = getAllContacts();

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="panel-card">
    <div class="panel-header panel-header-flex">
        <h2><i class="fas fa-address-book"></i> Pengaturan Kontak</h2>
        <span class="badge-count"><?= count($contacts) ?> item</span>
    </div>
    <div class="panel-body table-responsive">
        <?php if ($contacts === []): ?>
            <p class="text-muted">Belum ada data kontak.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Platform</th>
                        <th>Label</th>
                        <th>Username</th>
                        <th>Icon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><strong><?= e((string) $contact['platform']) ?></strong></td>
                        <td><?= e((string) $contact['label']) ?></td>
                        <td><?= e((string) $contact['username']) ?></td>
                        <td><i class="<?= e((string) $contact['icon_class']) ?>"></i> <code><?= e((string) $contact['icon_class']) ?></code></td>
                        <td class="table-actions">
                            <a href="<?= e(adminUrl('contacts/edit.php?id=' . (int) $contact['id'])) ?>" class="btn btn-sm btn-secondary">
                                <i class="fas fa-pen"></i> Edit
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
