<?php

// 'functions.php' HAS to be at the top
require 'functions.php';
// require 'router.php';

$dsn = "mysql:host=localhost;port=3306;dbname=learning_php;user=root;charset=utf8mb4";
$pdo = new PDO($dsn);

$stmt = $pdo->prepare("SELECT * FROM posts");
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

dd($posts);