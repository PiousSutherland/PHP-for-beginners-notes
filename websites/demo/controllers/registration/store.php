<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email))
    $errors['email'] = 'Please provide valid email.';
if (!Validator::string($password, 8))
    $errors['password'] = 'Password is minimum 8 characters long.';

if ($errors)
    return view(
        'registration/create.view.php',
        [
            'email' => $_POST['email'],
            'errors' => $errors
        ]
    );

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    header('location: /');
    exit();
} else {
    $db->query('insert into users(email, password) values(:email, :password)', [
        'email' => $email,
        'password' => $password
    ]);

    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();
}
