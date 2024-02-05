<?php

require __DIR__.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'functions.php';

$file = $_GET['filename'] ?? null;

$csv = read_csv(__DIR__.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.$file.'.csv');

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
