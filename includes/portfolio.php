<?php

declare(strict_types=1);

require_once __DIR__ . '/upload.php';

const PORTFOLIO_PER_PAGE = 5;

/**
 * @return list<array<string, mixed>>
 */
function getPublicPortfolios(): array
{
    $pdo = getDBConnection();
    $stmt = $pdo->query('SELECT * FROM portfolios ORDER BY id ASC');

    return $stmt->fetchAll();
}

/**
 * @return array{items: list<array<string, mixed>>, total: int, page: int, per_page: int, total_pages: int}
 */
function getPortfoliosPaginated(int $page = 1, int $perPage = PORTFOLIO_PER_PAGE): array
{
    $page = max(1, $page);
    $pdo = getDBConnection();

    $total = (int) $pdo->query('SELECT COUNT(*) FROM portfolios')->fetchColumn();
    $totalPages = max(1, (int) ceil($total / $perPage));
    $page = min($page, $totalPages);
    $offset = ($page - 1) * $perPage;

    $stmt = $pdo->prepare('SELECT * FROM portfolios ORDER BY created_at DESC, id DESC LIMIT :limit OFFSET :offset');
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return [
        'items'       => $stmt->fetchAll(),
        'total'       => $total,
        'page'        => $page,
        'per_page'    => $perPage,
        'total_pages' => $totalPages,
    ];
}

function getPortfolioById(int $id): ?array
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare('SELECT * FROM portfolios WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    return $row ?: null;
}

function portfolioLinkLabel(?string $url): string
{
    if ($url === null || trim($url) === '') {
        return '';
    }

    $lower = strtolower($url);

    if (str_contains($lower, 'youtube.com') || str_contains($lower, 'youtu.be')) {
        return '🎥 Lihat Video';
    }

    if (str_contains($lower, 'github.com')) {
        return '🔗 GitHub';
    }

    return '🔗 Kunjungi';
}

/**
 * @param array{title: string, description: string, tech_stack: string, project_link: ?string, image: string} $data
 */
function createPortfolio(array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'INSERT INTO portfolios (title, description, image, tech_stack, project_link)
         VALUES (:title, :description, :image, :tech_stack, :project_link)'
    );

    return $stmt->execute([
        ':title'        => $data['title'],
        ':description'  => $data['description'],
        ':image'        => $data['image'],
        ':tech_stack'   => $data['tech_stack'],
        ':project_link' => $data['project_link'] ?: null,
    ]);
}

/**
 * @param array{title: string, description: string, tech_stack: string, project_link: ?string, image: string} $data
 */
function updatePortfolio(int $id, array $data): bool
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'UPDATE portfolios SET
            title = :title,
            description = :description,
            image = :image,
            tech_stack = :tech_stack,
            project_link = :project_link
         WHERE id = :id'
    );

    return $stmt->execute([
        ':title'        => $data['title'],
        ':description'  => $data['description'],
        ':image'        => $data['image'],
        ':tech_stack'   => $data['tech_stack'],
        ':project_link' => $data['project_link'] ?: null,
        ':id'           => $id,
    ]);
}

function deletePortfolio(int $id): bool
{
    $item = getPortfolioById($id);
    if (!$item) {
        return false;
    }

    $pdo = getDBConnection();
    $stmt = $pdo->prepare('DELETE FROM portfolios WHERE id = ?');

    if ($stmt->execute([$id])) {
        deleteUploadedImage($item['image'] ?? null);
        return true;
    }

    return false;
}

/**
 * @return array{ok: bool, data: array<string, string>, errors: list<string>}
 */
function validatePortfolioInput(array $post, ?array $file, bool $isEdit, ?string $currentImage): array
{
    $errors = [];
    $title = trim((string) ($post['title'] ?? ''));
    $description = trim((string) ($post['description'] ?? ''));
    $techStack = trim((string) ($post['tech_stack'] ?? ''));
    $projectLink = trim((string) ($post['project_link'] ?? ''));
    $imagePath = $currentImage ?? '';

    if ($title === '') {
        $errors[] = 'Judul wajib diisi.';
    }

    if ($description === '') {
        $errors[] = 'Deskripsi wajib diisi.';
    }

    if ($projectLink !== '' && !filter_var($projectLink, FILTER_VALIDATE_URL)) {
        $errors[] = 'Link proyek tidak valid.';
    }

    $hasUpload = isset($file['error']) && $file['error'] !== UPLOAD_ERR_NO_FILE;

    if ($hasUpload) {
        $validation = validateImageUpload($file, false);
        if (!$validation['ok']) {
            $errors[] = $validation['message'];
        } else {
            $saved = saveUploadedImage($file, 'portfolio');
            if (!$saved['ok']) {
                $errors[] = $saved['message'];
            } else {
                $imagePath = $saved['path'];
            }
        }
    } elseif (!$isEdit || $imagePath === '') {
        $errors[] = 'Gambar wajib diunggah.';
    }

    return [
        'ok'    => $errors === [],
        'data'  => [
            'title'        => $title,
            'description'  => $description,
            'tech_stack'   => $techStack,
            'project_link' => $projectLink,
            'image'        => $imagePath,
        ],
        'errors' => $errors,
    ];
}
