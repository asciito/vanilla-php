<?php

/**
 * Join two or more paths
 */
function joinPaths(array $paths): string
{
    if (count($paths) < 2) {
        return $paths[0] ?? '';
    }

    return implode(DIRECTORY_SEPARATOR, $paths);
}

/**
 * Get the DB connection
 */
function connection(): SQLite3
{
    $file = joinPaths([__DIR__, '..', 'database', 'database.sqlite']);

    return new SQLite3($file);
}

/**
 * Flash a message or get a message from session
 */
function flash(string $key, string $message = null): string|null|bool
{
    if (empty($message)) {
        if (array_key_exists($key, $_SESSION)) {
            $message = $_SESSION[$key];

            unset($_SESSION[$key]);

            return $message;
        }

        return null;
    }

    $_SESSION[$key] = $message;

    return true;
}

/**
 * Redirect to the given URL
 */
function redirect(string $url): void
{
    header("Location: $url");

    exit();
}
