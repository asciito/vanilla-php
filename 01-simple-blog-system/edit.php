<?php

require __DIR__ . '/includes/config.php';

$id = $_GET['id'];
$title = $_POST['title'];
$content = $_POST['content'] ?? null;


$db = db();

$postQuery = $db->prepare(<<<SQL
    UPDATE posts
    SET title = :title, content = :content
    WHERE id = :id
SQL);

$done = $postQuery->execute(['id' => $id, 'title' => $title, 'content' => $content]);

if (! $done) {
    $message = "Something went wrong, we couldn't edit the post";
} else {
    $message = "You have updated the post [$title]";
}

header("Location: /?message=$message", true, 302);
