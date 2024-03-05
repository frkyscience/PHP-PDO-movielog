<?php

$dbhost = "localhost";
$dbname = "netland";
$dbuser = "bit_academy";
$dbpass = "bit_academy";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $series_query = "SELECT id, title, rating FROM series";
    $series_stmt = $conn->query($series_query);
    $series_rows = $series_stmt->fetchAll(PDO::FETCH_ASSOC);

    $films_query = "SELECT id, title, length_in_minutes FROM movies";
    $films_stmt = $conn->query($films_query);
    $films_rows = $films_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $err) {
    echo "Database connection problem. " . $err->getMessage();
}


