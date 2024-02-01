<?php
require __DIR__.'/includes/config.php';

$db = db();

$postsQuery = $db->query(<<<SQL
    SELECT *
    FROM posts
SQL);

$posts = $postsQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
</head>
<body>
<main>
    <form method="POST">
        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email">
        </div>

        <div>
            <label for="password">password</label>
            <input id="password" name="password" type="password">
        </div>

        <button type="submit">Login</button>
    </form>
</main>
</body>
</html>
