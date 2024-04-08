<?php

require 'Validator.php';

$db = new Database((require 'config.php')['database']);

$heading = 'Create a note';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    if (!Validator::string($_POST['body'], 1, 255)) {
        $errors['body'] = 'A body of no more than 255 characters is required.';
    }

    if (empty($errors))
        $db->query('insert into notes(body, user_id) values(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
}

require 'views/note-create.view.php';
