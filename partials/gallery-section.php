<?php

declare(strict_types=1);

$galleryItems = getPublicGalleryItems();
?>
    
    <section class="gallery" id="gallery">
        <div class="container">
            <h2 class="section-title">Galeri Pencapaian</h2>
            <div class="gallery-grid">
                <?php if ($galleryItems === []): ?>
                    <p style="color: var(--gray); grid-column: 1 / -1;">Belum ada foto galeri.</p>
                <?php else: ?>
                    <?php foreach ($galleryItems as $item): ?>
                        <?php $imgPath = (string) $item['image']; ?>
                <div class="gallery-item">
                    <img src="<?= e($imgPath) ?>" alt="<?= e(imagePathToAlt($imgPath)) ?>">
                </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
