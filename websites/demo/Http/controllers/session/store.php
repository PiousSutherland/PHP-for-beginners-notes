<?php

use Core\Authenticator;
use Core\Session;
use Core\ValidationException;
use Http\Forms\LoginForm;

// Fails
try {
    $form = LoginForm::validate($attributes = [
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);
} catch (ValidationException $exception) {
    Session::flash('errors', $form->errors());
    Session::flash('old', ['email' => $email]);

    return redirect('/login');
}
if ((new Authenticator())->attempt($attributes['email'], $attributes['password']))
    redirect('/');

$form->error('email', 'Credentials could not be matched.');

Session::flash('errors', $form->errors());
Session::flash('old', ['email' => $email]);

return redirect('/login');
