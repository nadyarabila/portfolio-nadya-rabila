<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';
requireAdminLogin();

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$track = getMusicTrackById($id);

if (!$track) {
    setFlash('error', 'Data lagu tidak ditemukan.');
    header('Location: ' . adminUrl('music/index.php'));
    exit;
}

$pageTitle = 'Edit Lagu';
$activePage = 'music';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $audioFile = $_FILES['audio_file'] ?? [];
    $coverFile = $_FILES['cover_image'] ?? [];
    
    $validated = validateMusicInput($_POST, $audioFile, $coverFile, true, $track);
    
    if ($validated['ok']) {
        $audioPath = (string) $track['audio_file'];
        $coverPath = $track['cover_image'];
        
        if (($audioFile['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            $audio = saveUploadedAudio($audioFile);
            if ($audio['ok']) {
                if (str_starts_with($audioPath, 'uploads/')) {
                    deleteUploadedImage($audioPath);
                }
                $audioPath = $audio['path'];
            } else {
                $errors[] = $audio['message'];
            }
        }
        
        if ($errors === [] && ($coverFile['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            $cover = saveUploadedImage($coverFile, 'music_covers', false);
            if ($cover['ok']) {
                if ($coverPath && str_starts_with($coverPath, 'uploads/')) {
                    deleteUploadedImage($coverPath);
                }
                $coverPath = $cover['path'];
            } else {
                $errors[] = $cover['message'];
            }
        }
        
        if ($errors === []) {
            $data = array_merge($validated['data'], [
                'audio_file' => $audioPath,
                'cover_image' => $coverPath
            ]);
            
            if (updateMusicTrack($id, $data)) {
                setFlash('success', 'Lagu berhasil diperbarui.');
                header('Location: ' . adminUrl('music/index.php'));
                exit;
            }
            $errors[] = 'Gagal memperbarui database.';
        }
    } else {
        $errors = $validated['errors'];
    }
    
    $track = array_merge($track, $_POST);
}

require dirname(__DIR__) . '/partials/layout-start.php';
?>

<div class="panel-card">
    <div class="panel-header">
        <h2><i class="fas fa-pen"></i> Edit Lagu: <?= e((string)$track['title']) ?></h2>
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
                    <input type="text" id="title" name="title" value="<?= e((string)$track['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="artist">Artist <span class="required">*</span></label>
                    <input type="text" id="artist" name="artist" value="<?= e((string)$track['artist']) ?>" required>
                </div>
                
                <div class="form-group form-full">
                    <label for="audio_file">Ganti File Audio <span class="hint">(Kosongkan jika tidak diganti) MP3, WAV, OGG · Maks 10MB</span></label>
                    <input type="file" id="audio_file" name="audio_file" accept=".mp3,.wav,.ogg">
                    <p class="small text-muted" style="margin-top:0.5rem;">File saat ini: <code><?= basename((string)$track['audio_file']) ?></code></p>
                </div>

                <?php 
                $currentImage = (string)($track['cover_image'] ?? '');
                $isEdit = true;
                $required = false;
                $inputId = 'cover_image';
                $previewId = 'coverPreview';
                require dirname(__DIR__) . '/partials/image-upload-field.php'; 
                ?>
            </div>

            <div class="form-actions">
                <a href="<?= e(adminUrl('music/index.php')) ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?php require dirname(__DIR__) . '/partials/layout-end.php'; ?>
