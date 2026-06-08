<?php

declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));
define('APP_NAME', 'Portfolio Nadya Rabila');

define('UPLOAD_DIR', APP_ROOT . DIRECTORY_SEPARATOR . 'uploads');
define('UPLOAD_URL_BASE', 'uploads');

define('UPLOAD_MAX_BYTES', 2 * 1024 * 1024); // 2MB
define('UPLOAD_ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);
define('UPLOAD_ALLOWED_AUDIO', ['mp3', 'wav', 'ogg']);
define('UPLOAD_MAX_AUDIO_BYTES', 10 * 1024 * 1024); // 10MB

define('UPLOAD_SUBDIRS', [
    'portfolio'      => UPLOAD_DIR . DIRECTORY_SEPARATOR . 'portfolio',
    'certifications' => UPLOAD_DIR . DIRECTORY_SEPARATOR . 'certifications',
    'achievements'   => UPLOAD_DIR . DIRECTORY_SEPARATOR . 'achievements',
    'gallery'        => UPLOAD_DIR . DIRECTORY_SEPARATOR . 'gallery',
    'music'          => UPLOAD_DIR . DIRECTORY_SEPARATOR . 'music',
    'music_covers'   => UPLOAD_DIR . DIRECTORY_SEPARATOR . 'music' . DIRECTORY_SEPARATOR . 'covers',
]);
