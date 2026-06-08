<?php

/** @var array{page: int, total_pages: int} $result */
if (($result['total_pages'] ?? 1) <= 1) {
    return;
}
?>
<nav class="pagination" aria-label="Paginasi">
    <?php if ($result['page'] > 1): ?>
        <a href="?page=<?= (int) $result['page'] - 1 ?>" class="page-link">&laquo; Sebelumnya</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $result['total_pages']; $i++): ?>
        <a href="?page=<?= $i ?>" class="page-link <?= $i === $result['page'] ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($result['page'] < $result['total_pages']): ?>
        <a href="?page=<?= (int) $result['page'] + 1 ?>" class="page-link">Selanjutnya &raquo;</a>
    <?php endif; ?>
</nav>
