<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$pageTitle = 'Tambah Lagu';
$activePage = 'music';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $audioFile = $_FILES['audio_file'] ?? [];
    $coverFile = $_FILES['cover_image'] ?? [];
    
    $validated = validateMusicInput($_POST, $audioFile, $coverFile, false);
    
    if ($validated['ok']) {
        $audio = saveUploadedAudio($audioFile);
        $coverPath = null;
        
        if ($audio['ok']) {
            if (($coverFile['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
                $cover = saveUploadedImage($coverFile, 'music_covers', false);
                if ($cover['ok']) {
                    $coverPath = $cover['path'];
                }
            }
            
            $data = array_merge($validated['data'], [
                'audio_file' => $audio['path'],
                'cover_image' => $coverPath
            ]);
            
            if (createMusicTrack($data)) {
                setFlash('success', 'Lagu berhasil ditambahkan ke playlist.');
                header('Location: ' . adminUrl('music/index.php'));
                exit;
            }
            $errors[] = 'Gagal menyimpan ke database.';
        } else {
            $errors[] = $audio['message'];
        }
    } else {
        $errors = $validated['errors'];
        $old = $_POST;
    }
}

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="panel-card">
    <div class="panel-header">
        <h2><i class="fas fa-plus"></i> Tambah Lagu Baru</h2>
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
                    <label for="title">Judul Lagu <span class="required">*</span></label>
                    <input type="text" id="title" name="title" value="<?= e((string)($old['title'] ?? '')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="artist">Artist <span class="required">*</span></label>
                    <input type="text" id="artist" name="artist" value="<?= e((string)($old['artist'] ?? '')) ?>" required>
                </div>
                
                <div class="form-group form-full">
                    <label for="audio_file">File Audio <span class="required">*</span> <span class="hint">MP3, WAV, OGG · Maks 10MB</span></label>
                    <input type="file" id="audio_file" name="audio_file" accept=".mp3,.wav,.ogg" required>
                </div>

                <div class="form-group form-full">
                    <label for="cover_image">Cover Image <span class="hint">(Opsional) JPG, PNG, WEBP · Maks 2MB</span></label>
                    <input type="file" id="cover_image" name="cover_image" accept=".jpg,.jpeg,.png,.webp" class="image-upload-input" data-preview="coverPreview">
                </div>

                <div class="form-group form-full">
                    <label>Preview Cover</label>
                    <div class="image-preview-box">
                        <img src="" alt="Preview" id="coverPreview" class="image-preview" style="display:none;">
                        <p class="preview-placeholder" id="previewPlaceholder">Belum ada gambar</p>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= e(adminUrl('music/index.php')) ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Lagu</button>
            </div>
        </form>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
