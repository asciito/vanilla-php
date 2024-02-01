<?php

function db(): PDO
{
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $dbuser = $_ENV['BD_USER'];
    $dbpass = $_ENV['DB_PASS'] ?? '';

    return new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
}
