<?php

$db = new Database((require 'config.php')['database']);

$heading = "My Notes";
$currentUserId = 1;

$note = $db->query(
    'select * from notes where  id = :id',
    [
        // 'user' => 1, //$_SESSION['user_id'],
        'id' => $_GET['id']
    ]
)->findOrFail();

authorize($note['user_id'] == $currentUserId);

require "views/notes/show.view.php";
