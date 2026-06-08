<?php

declare(strict_types=1);

$certifications = getPublicCertifications();
?>
    <section class="certifications" id="certifications">
        <div class="container">
            <h2 class="section-title">Sertifikat & Pelatihan</h2>
            <div class="cert-grid">
                <?php if ($certifications === []): ?>
                    <p style="color: var(--gray);">Belum ada data sertifikat.</p>
                <?php else: ?>
                    <?php foreach ($certifications as $item): ?>
                <div class="cert-card">
                    <div class="cert-content">
                        <h4><?= e((string) $item['title']) ?></h4>
                        <p style="color: var(--gray); font-size: 0.9rem;"><?= nl2br(e((string) $item['description'])) ?></p>
                        <button type="button" class="btn btn-outline cert-btn"
                            onclick='openModal(<?= json_encode((string) $item['image'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'
                            style="font-size: 0.8rem; padding: 0.4rem 1.2rem; margin-top: 0.8rem;">
                            <i class="fas fa-eye"></i> Lihat Sertifikat
                        </button>
                    </div>
                </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
