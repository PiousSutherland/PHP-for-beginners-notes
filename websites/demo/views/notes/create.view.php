<?php
view('partials/head.php');
view('partials/nav.php');
view('partials/banner.php', ['heading' => $heading]);
?>

<main class="flex items-center justify-center">
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <form method="post" action="/notes">
            <label for="body">Create</label>
            <div>
                <textarea name="body" id="body" cols="90" rows="10" placeholder="Put your note here!" 
                required><?= trim($_POST['body']) ?? '' ?></textarea>

                <?= isset($errors['body']) && empty($errors['body']) ?? "<p class=\"text-red-500 text-xs\">{$errors['body']}</p>" ?>
            </div>

            <p><button type="submit">Create</button></p>
        </form>
    </div>
</main>

<?php view('partials/footer.php') ?>