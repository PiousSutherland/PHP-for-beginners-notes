<?php

// 'functions.php' HAS to be at the top
require 'functions.php';
// require 'router.php';
require 'Database.php';

$db = new Database((require 'config.php')['database']);

$id = $_GET['id'];
$query = "SELECT * FROM posts where id = ?";

$posts = $db->query($query, [$id])->fetchAll(PDO::FETCH_ASSOC);
dd($posts);

// Check if multidimensional
if (isset($posts[0]) && is_array($posts[0])) {
    foreach ($posts as $post) {
        echo "<li>{$post['title']}</li>";
    }
} else {
    echo "<li>{$posts['title']}</li>";
}
