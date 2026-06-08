<?php

declare(strict_types=1);

/**
 * @return array{items: list<array<string, mixed>>, total: int, page: int, per_page: int, total_pages: int}
 */
function paginateTable(string $table, int $page = 1, int $perPage = 5, string $orderSql = 'created_at DESC, id DESC'): array
{
    $allowed = ['portfolios', 'certifications', 'achievements', 'gallery', 'contacts'];

    if (!in_array($table, $allowed, true)) {
        return ['items' => [], 'total' => 0, 'page' => 1, 'per_page' => $perPage, 'total_pages' => 1];
    }

    $page = max(1, $page);
    $pdo = getDBConnection();
    $total = (int) $pdo->query("SELECT COUNT(*) FROM `{$table}`")->fetchColumn();
    $totalPages = max(1, (int) ceil($total / $perPage));
    $page = min($page, $totalPages);
    $offset = ($page - 1) * $perPage;

    $stmt = $pdo->prepare("SELECT * FROM `{$table}` ORDER BY {$orderSql} LIMIT :limit OFFSET :offset");
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
