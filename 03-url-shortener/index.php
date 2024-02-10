<?php

session_start();

require __DIR__ . DIRECTORY_SEPARATOR . 'includes' .DIRECTORY_SEPARATOR . 'functions.php';

$db = connection();

$rows = null;

if ($_SERVER["REQUEST_URI"] !== '/') {
    $statement = $db->prepare(
        <<<SQL
        SELECT *
        FROM urls
        WHERE shortcode = :code;
        SQL
    );

    $statement->execute(['code' => trim($_SERVER["REQUEST_URI"], '/')]);

    if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $url = $row['real_url'];

        redirect($url);
    }
} else {
    $statement = $db->prepare(<<<SQL
        SELECT *
        FROM urls;
    SQL);

    $statement->execute();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>URL Shortener</title>
</head>
<body>
    <main>
        <form action="upload.php" method="POST">
            <div>
                <label for="url">Your URL</label>
                <input type="url" id="url" name="url">
            </div>

            <button type="submit">Submit</button>
        </form>

        <ul>
            <?php foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row): ?>
                <li>
                    <a href="/<?= $row['shortcode'] ?>">
                        <?= $row['shortcode']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if (($success = flash('success')) || ($error = flash('error'))): ?>
            <p><?= $success ?? $error ?></p>
        <?php endif; ?>
    </main>
</body>
</html>