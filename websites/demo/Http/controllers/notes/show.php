<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query(
    'select * from notes where  id = :id',
    [
        // 'user' => 1, //$_SESSION['user_id'],
        'id' => $_GET['id']
    ]
)->findOrFail();

authorize($note['user_id'] == $currentUserId);

require view("notes/show.view.php", [
    'heading' => 'My Notes',
    'note' => $note
]);
