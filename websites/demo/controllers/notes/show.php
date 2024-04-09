<?php

use Core\Database;

$db = new Database((require base_path('config.php'))['database']);

$currentUserId = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $note = $db->query(
        'select * from notes where  id = :id',
        [
            // 'user' => 1, //$_SESSION['user_id'],
            'id' => $_GET['id']
        ]
    )->findOrFail();

    authorize($note['user_id'] == $currentUserId);

    $db->query('delete from notes where id = :id', [
        'id' => $_GET['id']
    ]);

    header('location: /notes');
    exit();
} else {
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
}
