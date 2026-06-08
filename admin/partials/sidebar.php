<?php

/** @var string $activePage dashboard|portfolio|certifications|achievements|gallery|contacts */
$activePage = $activePage ?? 'dashboard';

$menu = [
    ['id' => 'profile-settings', 'label' => 'Pengaturan Profil', 'icon' => 'fa-user-cog',    'url' => adminUrl('profile-settings/index.php')],
    ['id' => 'dashboard',       'label' => 'Dashboard',       'icon' => 'fa-gauge-high',    'url' => adminUrl('dashboard.php')],
    ['id' => 'portfolio',       'label' => 'Portofolio',      'icon' => 'fa-briefcase',     'url' => adminUrl('portfolio/index.php')],
    ['id' => 'certifications',  'label' => 'Sertifikat',      'icon' => 'fa-certificate',   'url' => adminUrl('certifications/index.php')],
    ['id' => 'achievements',    'label' => 'Prestasi',        'icon' => 'fa-trophy',        'url' => adminUrl('achievements/index.php')],
    ['id' => 'gallery',         'label' => 'Galeri',          'icon' => 'fa-images',        'url' => adminUrl('gallery/index.php')],
    ['id' => 'music',           'label' => 'Musik',           'icon' => 'fa-music',         'url' => adminUrl('music/index.php')],
    ['id' => 'contacts',        'label' => 'Kontak',          'icon' => 'fa-address-book',  'url' => adminUrl('contacts/index.php')],
    ['id' => 'comments',        'label' => 'Komentar',        'icon' => 'fa-comments',      'url' => adminUrl('comments/index.php')],
];
?>
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <a href="<?= e(adminUrl('dashboard.php')) ?>">
            <span class="brand-accent">Nara</span>Admin
        </a>
    </div>

    <nav class="sidebar-nav">
        <?php foreach ($menu as $menuItem): ?>
            <?php
            $isActive = $activePage === $menuItem['id'];
            $classes = 'nav-item' . ($isActive ? ' active' : '');
            ?>
            <a href="<?= e($menuItem['url']) ?>" class="<?= e($classes) ?>">
                <i class="fas <?= e($menuItem['icon']) ?>"></i>
                <span><?= e($menuItem['label']) ?></span>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="sidebar-footer">
        <a href="<?= e(dirname(adminBaseUrl())) ?>/index.php" target="_blank" class="sidebar-link-out">
            <i class="fas fa-external-link-alt"></i> Lihat Website
        </a>
        <a href="<?= e(adminUrl('auth/logout.php')) ?>" class="sidebar-logout">
            <i class="fas fa-right-from-bracket"></i> Logout
        </a>
    </div>
</aside>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
