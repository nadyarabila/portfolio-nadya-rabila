<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$settings = getSiteSettings();
$pageTitle = 'Pengaturan Profil';
$activePage = 'profile-settings';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim((string) ($_POST['full_name'] ?? ''));
    $greeting = trim((string) ($_POST['greeting'] ?? ''));
    $tagline = trim((string) ($_POST['tagline'] ?? ''));
    $footer_name = trim((string) ($_POST['footer_name'] ?? ''));
    $footer_text = trim((string) ($_POST['footer_text'] ?? ''));
    
    $file = $_FILES['profile_image'] ?? [];
    $currentImage = (string) $settings['profile_image'];
    
    if ($full_name === '') $errors[] = 'Nama lengkap wajib diisi.';
    if ($greeting === '') $errors[] = 'Greeting wajib diisi.';
    if ($tagline === '') $errors[] = 'Tagline wajib diisi.';
    
    $newImagePath = $currentImage;
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
        $validation = validateImageUpload($file, false);
        if (!$validation['ok']) {
            $errors[] = $validation['message'];
        } else {
            $upload = saveUploadedImage($file, 'profile');
            if ($upload['ok']) {
                $newImagePath = $upload['path'];
                // Delete old image only if it was in uploads/
                if (str_starts_with($currentImage, 'uploads/')) {
                    deleteUploadedImage($currentImage);
                }
            } else {
                $errors[] = $upload['message'];
            }
        }
    }

    if ($errors === []) {
        $data = [
            'full_name'     => $full_name,
            'greeting'      => $greeting,
            'tagline'       => $tagline,
            'profile_image' => $newImagePath,
            'footer_name'   => $footer_name,
            'footer_text'   => $footer_text
        ];
        
        if (updateSiteSettings($data)) {
            setFlash('success', 'Pengaturan profil berhasil diperbarui.');
            header('Location: ' . adminUrl('profile-settings/index.php'));
            exit;
        }
        $errors[] = 'Gagal memperbarui database.';
    }
    
    $settings = array_merge($settings, [
        'full_name' => $full_name,
        'greeting' => $greeting,
        'tagline' => $tagline,
        'footer_name' => $footer_name,
        'footer_text' => $footer_text
    ]);
}

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="panel-card">
    <div class="panel-header">
        <h2><i class="fas fa-user-cog"></i> Pengaturan Profil & Website</h2>
    </div>
    <div class="panel-body">
        <?php if ($errors !== []): ?>
            <div class="alert alert-error" role="alert">
                <i class="fas fa-circle-exclamation"></i>
                <ul class="error-list"><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" class="admin-form">
            <div class="form-grid">
                <div class="form-group">
                    <label for="full_name">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="full_name" name="full_name" value="<?= e((string) $settings['full_name']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="greeting">Greeting Text <span class="required">*</span></label>
                    <input type="text" id="greeting" name="greeting" value="<?= e((string) $settings['greeting']) ?>" placeholder="👋 Halo, saya" required>
                </div>
                <div class="form-group form-full">
                    <label for="tagline">Tagline / Deskripsi Hero <span class="required">*</span></label>
                    <textarea id="tagline" name="tagline" rows="4" required><?= e((string) $settings['tagline']) ?></textarea>
                    <span class="hint">Mendukung tag HTML seperti &lt;strong&gt;.</span>
                </div>
                
                <div class="form-group">
                    <label for="footer_name">Nama di Footer</label>
                    <input type="text" id="footer_name" name="footer_name" value="<?= e((string) $settings['footer_name']) ?>">
                </div>
                <div class="form-group">
                    <label for="footer_text">Copyright Text (Footer)</label>
                    <input type="text" id="footer_text" name="footer_text" value="<?= e((string) $settings['footer_text']) ?>" placeholder="&copy; 2026">
                </div>

                <?php 
                $currentImage = (string) $settings['profile_image'];
                $isEdit = true;
                $required = false;
                $inputId = 'profile_image';
                $previewId = 'profilePreview';
                require dirname(__DIR__) . '/partials/image-upload-field.php'; 
                ?>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
