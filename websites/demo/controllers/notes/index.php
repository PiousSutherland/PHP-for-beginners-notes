<?php

use Core\Database;

$db = new Database(
    (require base_path('config.php'))['database']
);

$notes = $db->query('select * from notes where user_id = 1')->get();

require view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
