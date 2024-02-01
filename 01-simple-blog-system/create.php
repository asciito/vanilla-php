<?php

require __DIR__ . '/includes/config.php';

$title = $_POST['title'];
$content = $_POST['content'] ?? null;


$db = db();

$postQuery = $db->prepare(<<<SQL
    INSERT INTO posts (title, content)
    VALUES (:title, :content)
SQL);

$done = $postQuery->execute(['title' => $title, 'content' => $content]);

if (! $done) {
    $message = "Something went wrong, we couldn't create a new post";
} else {
    $message = "You have created a new post [$title]";
}

header("Location: /?message=$message", true, 302);
