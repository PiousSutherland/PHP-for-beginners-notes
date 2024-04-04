<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
</head>

<body>
    <?php foreach (filter($books, function ($book) {
        return $book['year'] < 2000;
    }) as $book) : ?>
        <ul>
            <li><a href="<?= $book['purchaseUrl'] ?>"><?= $book['name']; ?></a>, <?= $book['year'] ?></li>
            <li>Author: <?= $book['author']; ?></li>
        </ul>
    <?php endforeach; ?>
</body>

</html>