<?php

use Core\Database;
use Core\Validator;

$db = new Database(
    (require base_path('config.php'))['database']
);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!Validator::string($_POST['body'], 1, 255)) {
        $errors['body'] = 'A body of no more than 255 characters is required.';
    }

    if (empty($errors))
        $db->query('insert into notes(body, user_id) values(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
}

view('notes/create.view.php', [
    'heading' => 'Create a note',
    'errors' => $errors
]);
