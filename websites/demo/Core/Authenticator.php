<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        // Not in DB
        if (!$user || !password_verify($password, $user['password']))
            return false;
        else {
            $this->login($user);

            return true;
        }
    }

    public function login($user)
    {
        $_SESSION['user'] = ['email' => $user['email']];

        session_regenerate_id(true);
    }

    public static function logout()
    {
        Session::destroy();
    }
}
