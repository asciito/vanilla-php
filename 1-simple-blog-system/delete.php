<?php

require __DIR__ . '/includes/config.php';

$id = $_GET['id'];

$db = db();

$postQuery = $db->prepare(<<<SQL
    DELETE FROM posts
    WHERE id = :id
SQL);

$done = $postQuery->execute(['id' => $id]);

if (! $done) {
    $message = "Something went wrong, we couldn't delete the post";
} else {
    $message = "You delete the post";
}

header("Location: /?message=$message", true, 302);
