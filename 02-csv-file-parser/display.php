<?php


/**
 * Read a CSV file
 *
 * @param string $filename The name of the file to read
 * @return array|false Array with the CSV values, false if the file doesn't exist
 */
function read_csv(string $filename): array|false
{
    $file = implode(DIRECTORY_SEPARATOR, [__DIR__, 'storage', "$filename.csv"]);

    if (! file_exists($file)) {
        return false;
    }

    // OPEN FILE
    $stream = fopen($file, 'r');

    // READ FIRST LINE (HEADERS)
    $headers = explode(',', fgets($stream));

    if (count($headers) <= 0) {
        throw new RuntimeException("The file is not a valid CSV file");
    }

    $csv['headers'] = $headers;

    if (! feof($stream)) {
        // READ THE REST OF THE LINES
        while (! feof($stream)) {
            $line = fgets($stream);

            if ($line === false) {
                throw new RuntimeException('There was an error trying to read a line from the file');
            }

            $csv['rows'][] = explode(',', $line);
        }
    }

    // CLOSE FILE
    fclose($stream);

    return $csv;
}

$filename = htmlspecialchars($_GET['filename'] ?? '', encoding: 'UTF-8');

$csv = read_csv($filename);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>CSV Files</title>
</head>
<body>
    <main>
        <?php if (! empty($csv)): ?>
            <table>
                <thead>
                    <tr>
                        <?php foreach ($csv['headers'] as $header): ?>
                            <th><?= $header ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($csv['rows'] as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <td><?= $value ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>The file requested is not available, or not exists at all</p>
        <?php endif; ?>
    </main>
</body>
</html>
