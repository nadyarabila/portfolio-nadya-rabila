<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__DIR__) . '/config/app.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/flash.php';
require_once __DIR__ . '/upload.php';
require_once __DIR__ . '/pagination.php';
require_once __DIR__ . '/portfolio.php';
require_once __DIR__ . '/certifications.php';
require_once __DIR__ . '/achievements.php';
require_once __DIR__ . '/gallery.php';
require_once __DIR__ . '/contacts.php';
require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/music.php';
require_once __DIR__ . '/comments.php';
