<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/bootstrap.php';
require_once __DIR__ . '/auth.php';

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

define('ADMIN_FS_PATH', dirname(__DIR__));

/**
 * Base URL folder admin
 */
function adminBaseUrl(): string
{
    static $base = null;

    if ($base !== null) {
        return $base;
    }

    $docRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']) ?: '');
    $adminDir = str_replace('\\', '/', realpath(ADMIN_FS_PATH) ?: ADMIN_FS_PATH);
    $base = rtrim(str_replace($docRoot, '', $adminDir), '/');

    return $base;
}

function adminUrl(string $path = ''): string
{
    $path = ltrim($path, '/');
    $base = adminBaseUrl();

    return $path === '' ? $base : $base . '/' . $path;
}

function adminAsset(string $path): string
{
    return adminUrl('assets/' . ltrim($path, '/'));
}
