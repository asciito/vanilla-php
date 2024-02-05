<?php

/**
 * Get the files from a directory
 *
 * @param string $dir
 * @return array|false Array of files, or false if the directory path not exists
 */
function getFiles(string $dir): array|false
{
    $dir = rtrim($dir, DIRECTORY_SEPARATOR);

    if (! file_exists($dir)) {
        return false;
    }

    $handler = opendir($dir);

    $files = [];

    if ($handler) {
        while (false !== $file = readdir($handler)) {
            if ($file === '.' || $file === '..' || $file === '.gitignore') {
                continue;
            }

            $files[] = $file;
        }

        closedir($handler);
    }

    return $files;
}

$message = $_GET['message'] ?? null;

$storage = __DIR__.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>CSV Files</title>
</head>
<body>
    <main>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="file">Upload File</label>
                <input type="file" id="name" name="file" accept=".csv">
            </div>

            <button type="submit">Submit</button>
        </form>

        <?php if ($files = getFiles($storage)): ?>
        <ul>
            <?php foreach ($files as $file): ?>
                <li>
                    <a href="./display.php?filename=<?= $file = rtrim($file, '.csv'); ?>" target="_blank">
                        <?= $file ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
