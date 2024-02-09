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