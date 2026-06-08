<?php

declare(strict_types=1);

$achievements = getPublicAchievements();
?>
    
    <section class="achievements" id="achievements">
        <div class="container">
            <h2 class="section-title">Prestasi Unggulan</h2>

            <?php if ($achievements === []): ?>
                <p style="color: var(--gray);">Belum ada data prestasi.</p>
            <?php else: ?>
                <?php foreach ($achievements as $item): ?>
                    <?php
                    $imgPath = (string) $item['image'];
                    $imgAlt = imagePathToAlt($imgPath);
                    ?>
            <div class="achievement-card">
                <div class="achievement-photo">
                    <img src="<?= e($imgPath) ?>" alt="<?= e($imgAlt) ?>">
                </div>
                <div class="achievement-info">
                    <h3><?= e((string) $item['title']) ?></h3>
                    <p class="year"><?= e((string) $item['year']) ?></p>
                    <p><?= e((string) $item['description']) ?></p>
                    <button type="button" class="btn btn-outline cert-btn"
                        onclick='openModal(<?= json_encode($imgPath, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'
                        style="font-size: 0.8rem; padding: 0.4rem 1.2rem; margin-top: 0.8rem;">
                        <i class="fas fa-eye"></i> Lihat Sertifikat
                    </button>
                </div>
            </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
