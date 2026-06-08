<?php

declare(strict_types=1);

const FLASH_KEY = '_flash_messages';

/**
 * @param 'success'|'error'|'info' $type
 */
function setFlash(string $type, string $message): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION[FLASH_KEY][$type][] = $message;
}

/**
 * @return list<array{type: string, message: string}>
 */
function getFlashes(): array
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $messages = [];
    $stored = $_SESSION[FLASH_KEY] ?? [];
    unset($_SESSION[FLASH_KEY]);

    foreach ($stored as $type => $items) {
        foreach ((array) $items as $message) {
            $messages[] = [
                'type'    => (string) $type,
                'message' => (string) $message,
            ];
        }
    }

    return $messages;
}

function hasFlashes(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    return !empty($_SESSION[FLASH_KEY]);
}
