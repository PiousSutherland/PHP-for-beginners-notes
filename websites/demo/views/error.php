<?php
require 'partials/head.php';
require 'partials/nav.php';

$errorMessages = [
    // Client
    400 => 'Bad Request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not Found',

    // Server
    500 => 'Internal Server Error',
];

require 'partials/banner.php';
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6"><?= $errorMessages[$heading] ? $errorMessages[$heading] : 'Unknown error' ?></h1>
        
        <p class="t-4">
            <a href="/" class="text-blue-600 underline">Go back home.</a>
        </p>
    </div>
</main>

<?php require 'partials/footer.php' ?>