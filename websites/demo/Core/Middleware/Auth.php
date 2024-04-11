<?php

namespace Core\Middleware;

use Core\Response;

class Auth
{
    public function handle()
    {
        if (!$_SESSION['user'] ?? false) {
            abort(Response::UNAUTHORIZED);
        }
    }
}
