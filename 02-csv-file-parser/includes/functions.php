<?php

/**
 * @param string $file The file to read
 * @return array|false Array with the CSV values, false if the file doesn't exist
 */
function read_csv(string $file): array|false
{
    if (!file_exists($file)) {
        return false;
    }

    $csv = [];

    $fileStream = fopen($file, 'r');

    $headers = explode(',', fgets($fileStream));

    if (count($headers) <= 0) {
        throw new RuntimeException("The file is not a valid CSV file");
    }

    $csv['headers'] = array_filter($headers, fn ($header) => ! empty($header));

    while (! feof($fileStream)) {
        $line = fgets($fileStream);

        $csv['rows'][] = explode(',', $line);
    }

    return $csv;
}