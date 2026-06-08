<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/init.php';

adminLogout();

header('Location: ' . adminUrl('auth/login.php'));
exit;
