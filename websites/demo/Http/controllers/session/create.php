<?php

view('session/create.view.php', [
    'heading' => 'Log in',
    'errors' => $_SESSION['_flash']['errors'] ?? []
]);
