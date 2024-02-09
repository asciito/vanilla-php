<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('This script only accepts POST method');
}

require __DIR__ . DIRECTORY_SEPARATOR . 'includes' .DIRECTORY_SEPARATOR . 'functions.php';

$url = $_POST['url'];

// Transform URL
$hash = md5($url);

$db = connection();

$query = $db->prepare(
    <<<SQL
    INSERT INTO urls (real_url, shortcode)
    VALUES (:real, :short);
    SQL
);

$query->bindValue('real', $url);
$query->bindValue('short', $hash);

$result = $query->execute();

if ($result === false) {
    flash('error', "The URL is already uploaded.");
} else {
    flash('success', 'The URL was uploaded');
}

header("Location: /");