<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/init.php';

if (isAdminLoggedIn()) {
    header('Location: ' . adminUrl('dashboard.php'));
} else {
    header('Location: ' . adminUrl('auth/login.php'));
}
exit;
