<?php

Core\Authenticator::logout();

header('location: /');
exit();