<?php
$comments = getAllComments();
$commentCount = getCommentCount();
$flashes = getFlashes();
?>

<style>
    .comments-section {
        padding: 10rem 0 !important;
        margin-top: 4rem;
        position: relative;
        z-index: 1;
        background: rgba(10, 15, 30, 0.45) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-top: 1px solid rgba(14, 165, 233, 0.1);
        box-shadow: inset 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .comments-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 4rem;
    }

    .comments-title {
        font-size: 2rem;
        font-weight: 700;
        text-align: left;
        margin-bottom: 4rem;
        color: var(--white);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .comments-layout {
        display: grid;
        grid-template-columns: 60% 40%;
        gap: 6rem;
        align-items: start;
    }

    .comments-list-column {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
        position: relative;
    }

    .comment-item-simple {
        padding-bottom: 2.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        animation: fadeInUp 0.5s ease-out both;
    }

    .comment-item-simple:last-child {
        border-bottom: none;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .comment-user-name {
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--secondary);
    }

    .comment-date-simple {
        font-size: 0.85rem;
        color: var(--gray);
        opacity: 0.8;
    }

    .comment-text-simple {
        font-size: 1rem;
        color: rgba(248, 250, 252, 0.9);
        line-height: 1.7;
        white-space: pre-line;
    }

    .comments-form-column {
        position: sticky;
        top: 120px;
        padding: 2.5rem;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 20px;
    }

    .comments-form-column::before {
        display: none;
    }

    .form-title-modern {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--white);
        text-align: center;
    }

    .input-modern {
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 8px;
        padding: 0.8rem 1rem;
        color: var(--white);
        font-size: 0.9rem;
        margin-bottom: 1.2rem;
        outline: none;
        transition: all 0.3s ease;
    }

    .input-modern:focus {
        border-color: rgba(14, 165, 233, 0.4);
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 15px rgba(14, 165, 233, 0.1);
    }

    .btn-submit-modern {
        width: 100%;
        padding: 0.8rem;
        font-weight: 600;
        font-size: 0.9rem;
        border-radius: 8px;
        letter-spacing: 0.5px;
    }

    .load-more-minimal {
        background: transparent;
        border: none;
        color: var(--gray);
        font-size: 0.85rem;
        cursor: pointer;
        padding: 1rem 0;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .load-more-minimal:hover {
        color: var(--secondary);
        transform: translateX(5px);
    }

    .hidden-comment-simple {
        display: none;
    }

    @media (max-width: 992px) {
        .comments-section {
            padding: 6rem 0 !important;
        }
        .comments-container {
            padding: 0 2rem;
        }
        .comments-layout {
            grid-template-columns: 1fr;
            gap: 3rem;
        }
        .comments-form-column {
            position: static;
            padding: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
        .comments-form-column::before { display: none; }
    }

    @media (max-width: 600px) {
        .comments-section {
            padding: 4rem 0 !important;
        }
        .comments-container {
            padding: 0 1.5rem;
        }
        .comments-title {
            font-size: 1.6rem;
            margin-bottom: 2.5rem;
        }
    }
</style>

<section class="comments-section" id="comments">
    <div class="comments-container">
        <h2 class="comments-title">💬 Visitor Comments (<?php echo $commentCount; ?>)</h2>

        <?php foreach ($flashes as $flash): ?>
            <div style="margin-bottom: 2rem; border: 1px solid var(--secondary); border-radius: 8px; background: rgba(14, 165, 233, 0.05); padding: 0.8rem; text-align: center;">
                <p style="color: var(--secondary); font-size: 0.85rem; margin: 0;">
                    <i class="fas fa-check-circle"></i> <?php echo e($flash['message']); ?>
                </p>
            </div>
        <?php endforeach; ?>

        <div class="comments-layout">
            <div class="comments-list-column">
                <?php if (empty($comments)): ?>
                    <p style="color: var(--gray); font-style: italic;">"Belum ada komentar. Jadilah orang pertama yang memberikan komentar."</p>
                <?php else: ?>
                    <?php foreach ($comments as $index => $comment): ?>
                        <div class="comment-item-simple <?php echo $index >= 3 ? 'hidden-comment-simple' : ''; ?>">
                            <div class="comment-header">
                                <span class="comment-user-name"><?php echo e($comment['nama']); ?></span>
                                <span class="comment-date-simple">
                                    <i class="far fa-calendar-alt"></i> 
                                    <?php echo date('d M Y', strtotime($comment['created_at'])); ?>
                                </span>
                            </div>
                            <div class="comment-text-simple"><?php echo e($comment['komentar']); ?></div>
                        </div>
                    <?php endforeach; ?>

                    <?php if ($commentCount > 3): ?>
                        <button id="loadMoreComments" class="load-more-minimal" data-state="initial">
                            Lihat komentar lainnya <i class="fas fa-arrow-down"></i>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="comments-form-column">
                <h3 class="form-title-modern">Tinggalkan Komentar</h3>
                <form action="#comments" method="POST">
                    <input type="text" name="nama" id="nama" class="input-modern" required placeholder="Nama Anda">
                    <textarea name="komentar" id="komentar" rows="4" class="input-modern" required placeholder="Tulis komentar Anda..."></textarea>
                    <button type="submit" name="submit_comment" class="btn btn-primary btn-submit-modern">
                        <i class="fas fa-paper-plane"></i> Kirim Komentar
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('loadMoreComments')?.addEventListener('click', function() {
        const hiddenItems = document.querySelectorAll('.hidden-comment-simple');
        const isShowingAll = this.getAttribute('data-state') === 'all';
        const commentsList = document.querySelector('.comments-list-column');

        if (!isShowingAll) {
            hiddenItems.forEach(el => {
                el.style.display = 'block';
                el.style.animation = 'fadeInUp 0.5s ease-out both';
            });
            this.innerHTML = 'Lihat lebih sedikit <i class="fas fa-arrow-up"></i>';
            this.setAttribute('data-state', 'all');
        } else {
            hiddenItems.forEach(el => {
                el.style.display = 'none';
            });
            this.innerHTML = 'Lihat komentar lainnya <i class="fas fa-arrow-down"></i>';
            this.setAttribute('data-state', 'initial');
            
            commentsList.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
</script>
