<?php

namespace Core;

class Response
{
    // Client
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;

    // Server
    const InternalServerError = 500;
}
