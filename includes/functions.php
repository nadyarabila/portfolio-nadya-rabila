<?php

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 *
 * @param string $type portfolio|certifications|achievements|gallery
 */
function uploadPath(string $type): string
{
    if (!isset(UPLOAD_SUBDIRS[$type])) {
        throw new InvalidArgumentException("Tipe upload tidak dikenal: {$type}");
    }

    return UPLOAD_SUBDIRS[$type];
}

function uploadUrl(string $type, string $filename): string
{
    return UPLOAD_URL_BASE . '/' . rawurlencode($type) . '/' . rawurlencode($filename);
}

/**
 *
 * @return list<string>
 */
function parseTechStack(?string $techStack): array
{
    if ($techStack === null || trim($techStack) === '') {
        return [];
    }

    $items = array_map('trim', explode(',', $techStack));

    return array_values(array_filter($items, static fn(string $item): bool => $item !== ''));
}

function formatDateId(?string $datetime): string
{
    if ($datetime === null || $datetime === '') {
        return '';
    }

    $timestamp = strtotime($datetime);
    if ($timestamp === false) {
        return '';
    }

    return date('d M Y', $timestamp);
}
