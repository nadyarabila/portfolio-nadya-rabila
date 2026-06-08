<?php

declare(strict_types=1);

$portfolios = getPublicPortfolios();
?>
    <section class="portfolio" id="portfolio">
        <div class="container">
            <h2 class="section-title">Portofolio Proyek</h2>
            <div class="portfolio-grid">
                <?php if ($portfolios === []): ?>
                    <p style="color: var(--gray); grid-column: 1 / -1;">Belum ada proyek portofolio.</p>
                <?php else: ?>
                    <?php foreach ($portfolios as $item): ?>
                        <?php
                        $techItems = parseTechStack($item['tech_stack'] ?? '');
                        $projectLink = trim((string) ($item['project_link'] ?? ''));
                        $linkLabel = portfolioLinkLabel($projectLink !== '' ? $projectLink : null);
                        $imgAlt = preg_replace('/[\x{1F300}-\x{1F9FF}]/u', '', (string) $item['title']);
                        $imgAlt = trim($imgAlt) !== '' ? trim($imgAlt) : (string) $item['title'];
                        ?>
                <div class="portfolio-card">
                    <div class="portfolio-card-image">
                        <img src="<?= e((string) $item['image']) ?>" alt="<?= e($imgAlt) ?>">
                    </div>
                    <div class="portfolio-card-body">
                        <h3><?= e((string) $item['title']) ?></h3>
                        <p><?= e((string) $item['description']) ?></p>
                        <?php if ($techItems !== []): ?>
                        <div class="tech-stack">
                            <?php foreach ($techItems as $tech): ?>
                            <span><?= e($tech) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($projectLink !== ''): ?>
                        <a href="<?= e($projectLink) ?>" class="btn btn-outline"
                            style="font-size: 0.8rem; padding: 0.4rem 1.2rem; margin-top: 0.5rem;" target="_blank"
                            rel="noopener noreferrer"><?= e($linkLabel) ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
