<?php
$message = $_GET['message'] ?? null;

$storage = __DIR__.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR;

$handler = opendir($storage);
$files = [];

if ($handler) {
    while (false !== $file = readdir($handler)) {
        if ($file === '.' || $file === '..' || $file === '.gitkeep') {
            continue;
        }

        $files[] = $storage.$file;
    }

    closedir($handler);
}
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

        <?php if (!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
