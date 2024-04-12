<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

// Fails
if ($form->validate($email, $password)) {
    if ((new Authenticator())->attempt($email, $password))
        redirect('/');

    $form->error('email', 'Credentials could not be matched.');
}

Session::flash('errors', $form->errors());

return redirect('/login');