<?php

declare(strict_types=1);

const ADMIN_SESSION_KEY = 'admin_id';
const ADMIN_USERNAME_KEY = 'admin_username';

function isAdminLoggedIn(): bool
{
    return isset($_SESSION[ADMIN_SESSION_KEY]) && (int) $_SESSION[ADMIN_SESSION_KEY] > 0;
}

function currentAdminUsername(): string
{
    return (string) ($_SESSION[ADMIN_USERNAME_KEY] ?? '');
}

function requireAdminLogin(): void
{
    if (!isAdminLoggedIn()) {
        header('Location: ' . adminUrl('auth/login.php'));
        exit;
    }
}

function requireAdminGuest(): void
{
    if (isAdminLoggedIn()) {
        header('Location: ' . adminUrl('dashboard.php'));
        exit;
    }
}

/**
 * @return array{ok: bool, message: string}
 */
function attemptAdminLogin(string $username, string $password): array
{
    $username = trim($username);

    if ($username === '' || $password === '') {
        return ['ok' => false, 'message' => 'Username dan password wajib diisi.'];
    }

    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare('SELECT id, username, password FROM admins WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if (!$admin || !password_verify($password, $admin['password'])) {
            return ['ok' => false, 'message' => 'Username atau password salah.'];
        }

        session_regenerate_id(true);
        $_SESSION[ADMIN_SESSION_KEY] = (int) $admin['id'];
        $_SESSION[ADMIN_USERNAME_KEY] = (string) $admin['username'];

        return ['ok' => true, 'message' => 'Login berhasil.'];
    } catch (PDOException) {
        return ['ok' => false, 'message' => 'Koneksi database gagal. Periksa config/database.php.'];
    }
}

function adminLogout(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            (bool) $params['secure'],
            (bool) $params['httponly']
        );
    }

    session_destroy();
}

function adminTableCount(string $table): int
{
    $allowed = ['portfolios', 'certifications', 'achievements', 'gallery', 'contacts'];

    if (!in_array($table, $allowed, true)) {
        return 0;
    }

    try {
        $pdo = getDBConnection();
        $stmt = $pdo->query("SELECT COUNT(*) FROM `{$table}`");

        return (int) $stmt->fetchColumn();
    } catch (PDOException) {
        return 0;
    }
}
