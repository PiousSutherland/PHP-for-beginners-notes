<?php
view('partials/head.php');
view('partials/nav.php');
view('partials/banner.php');
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-6">
            <a href="/notes" class="text-blue-500 hover:underline">Go back</a>
        </p>
        <p><?= htmlspecialchars($note['body'])  ?></p>

        <form action="" method="post" class="mt-6">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <button class="text-sm text-red-500" type="submit">Delete</button>
        </form>
    </div>
</main>

<?php view('partials/footer.php') ?>