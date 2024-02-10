<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('This script only accepts POST method');
}

require __DIR__ . DIRECTORY_SEPARATOR . 'includes' .DIRECTORY_SEPARATOR . 'functions.php';

$url = filter_var($_POST['url'], FILTER_VALIDATE_URL, ["options" => FILTER_NULL_ON_FAILURE]);

if (empty($url)) {
    flash('error', 'The value provided, is not a valid URL');

    redirect('/');
}

// Transform URL
$hash = md5($url);

$db = connection();

$statement = $db->prepare(
    <<<SQL
    INSERT INTO urls (real_url, shortcode)
    VALUES (:real, :short);
    SQL
);

try {
    $statement->execute(['real' => $url, 'short' => $hash]);

    flash('success', 'The URL was uploaded');
} catch (PDOException $e) {
    flash('error', "The URL is already uploaded.");
}

redirect('/');