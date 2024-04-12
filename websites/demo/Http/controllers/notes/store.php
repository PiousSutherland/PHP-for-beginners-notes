<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string($_POST['body'], 1, 255)) {
    $errors['body'] = 'A body of no more than 255 characters is required.';
}

if ($errors) {
    return view('notes/create.view.php', [
        'heading' => 'Create a note',
        'errors' => $errors
    ]);
}

$db->query('insert into notes(body, user_id) values(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1
]);

header('location: /notes');
die();
