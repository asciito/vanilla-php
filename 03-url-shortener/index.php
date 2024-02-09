<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'includes' .DIRECTORY_SEPARATOR . 'functions.php';

$db = connection();

if ($_SERVER["REQUEST_URI"] !== '/') {
    $statement = $db->prepare(<<<SQL
    SELECT *
    FROM urls
    WHERE shortcode = :code;
    SQL);

    $statement->bindValue('code', trim($_SERVER["REQUEST_URI"], '/'));

    $result = $statement->execute();

    if ($result->numColumns() !== 0) {
        $row = $result->fetchArray(SQLITE3_ASSOC);

        $url = $row['real_url'];

        header("Location: $url", true, 302);
        exit();
    }
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
    </main>
</body>
</html>