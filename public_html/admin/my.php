<?php
require '../../bootloader.php';

$nav = nav();

$fileDB = new FileDB(DB_FILE);
$fileDB->load();

if (is_logged_in()) {
    $h3 = "Sveiki sugrize {$_SESSION['email']}";
    $pixels = $fileDB->getRowsWhere('pixels', ['email' => $_SESSION['email']]);
} else {
    header("Location: /login.php");
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/media/style.css">
    <title>My wall</title>
</head>
<body>
<main>
    <header>

        <?php require ROOT . '/app/templates/nav.tpl.php'; ?>

    </header>
    <section class="wrapper">
        <h1 class="header header--main">Welcome to YOUR P-00PWALL</h1>
        <h3 class="header"><?php print $h3; ?></h3>
        <div class="wall">

            <?php foreach ($pixels as $pixel) : ?>

                <span class="pixel <?php print $pixel['color']; ?>" style="left:<?php print $pixel['x']; ?>px; top:<?php print $pixel['y']; ?>px"></span>

            <?php endforeach; ?>

        </div>
    </section>
</main>
</body>
</html>