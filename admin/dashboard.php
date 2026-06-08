<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/init.php';

requireAdminLogin();

$pageTitle = 'Dashboard';
$activePage = 'dashboard';

$stats = [
    ['label' => 'Portofolio',    'count' => adminTableCount('portfolios'),      'icon' => 'fa-briefcase',   'color' => 'sky'],
    ['label' => 'Sertifikat',    'count' => adminTableCount('certifications'), 'icon' => 'fa-certificate', 'color' => 'violet'],
    ['label' => 'Prestasi',      'count' => adminTableCount('achievements'),   'icon' => 'fa-trophy',      'color' => 'amber'],
    ['label' => 'Galeri',        'count' => adminTableCount('gallery'),          'icon' => 'fa-images',      'color' => 'emerald'],
    ['label' => 'Kontak',        'count' => adminTableCount('contacts'),         'icon' => 'fa-address-book','color' => 'rose'],
];

require __DIR__ . '/partials/layout-start.php';
?>

<div class="dashboard-grid">
    <?php foreach ($stats as $stat): ?>
        <div class="stat-card stat-<?= e($stat['color']) ?>">
            <div class="stat-icon">
                <i class="fas <?= e($stat['icon']) ?>"></i>
            </div>
            <div class="stat-body">
                <p class="stat-label"><?= e($stat['label']) ?></p>
                <p class="stat-value"><?= (int) $stat['count'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="panel-card">
    <div class="panel-header">
        <h2><i class="fas fa-bolt text-accent"></i> Quick Actions</h2>
    </div>
    <div class="panel-body">
        <p style="margin-bottom: 1.5rem; color: var(--gray);">Akses cepat untuk menambah atau mengelola konten utama website.</p>
        
        <style>
            .quick-actions-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 1rem;
            }
            .action-item {
                display: flex;
                align-items: center;
                gap: 0.8rem;
                padding: 1rem;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
                text-decoration: none;
                color: var(--light);
                transition: all 0.3s ease;
            }
            .action-item:hover {
                background: rgba(37, 99, 235, 0.1);
                border-color: var(--secondary);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }
            .action-item i {
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 8px;
                color: var(--secondary);
                font-size: 1rem;
            }
            .action-label {
                font-size: 0.9rem;
                font-weight: 500;
            }
        </style>

        <div class="quick-actions-grid">
            <a href="<?= e(adminUrl('portfolio/create.php')) ?>" class="action-item">
                <i class="fas fa-briefcase"></i>
                <span class="action-label">Tambah Portfolio</span>
            </a>
            <a href="<?= e(adminUrl('certifications/create.php')) ?>" class="action-item">
                <i class="fas fa-certificate"></i>
                <span class="action-label">Tambah Sertifikat</span>
            </a>
            <a href="<?= e(adminUrl('achievements/create.php')) ?>" class="action-item">
                <i class="fas fa-trophy"></i>
                <span class="action-label">Tambah Prestasi</span>
            </a>
            <a href="<?= e(adminUrl('gallery/create.php')) ?>" class="action-item">
                <i class="fas fa-images"></i>
                <span class="action-label">Upload Galeri</span>
            </a>
            <a href="<?= e(adminUrl('comments/index.php')) ?>" class="action-item">
                <i class="fas fa-comments"></i>
                <span class="action-label">Kelola Komentar</span>
            </a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/partials/layout-end.php'; ?>
