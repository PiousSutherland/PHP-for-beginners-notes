<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
// Validation
if (!$email || !$password) {
    return view('sessions/create.view.php', [
        'errors' => ['email' => 'You need to input values.']
    ]);
} else if (!Validator::email($email)) {
    $errors['email'] = 'Please insert a valid email address';
}

// Return
if ($errors)
    return view('sessions/create.view.php', ['errors' => $errors]);

// Check Credentials
$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

// Credentials did not match
if (!$user) {
    return view('sessions/create.view.php', [
        'errors' => ['email' => 'Credentials could not be matched.']
    ]);
}
if (!password_verify($password, $user['password']))
    return view('sessions/create.view.php', [
        'errors' => ['email' => 'Credentials could not be matched.']
    ]);

login(['email' => $email]);

header('location: /');
exit();
