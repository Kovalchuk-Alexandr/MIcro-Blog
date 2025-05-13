<?php
    require("config.php");
    require("db.php");
    require "functions/all.php";

    if (isset($_GET['theme'])) {
        if ($_GET['theme'] == 'light') {
            setcookie('theme','light',  time() + 60 * 60 * 24 * 30);
            header('Location: ' . HOST);
        } elseif ($_GET['theme'] == 'dark') {
            setcookie('theme','dark',  time() + 60 * 60 * 24 * 30);
            header('Location: ' . HOST);
        }
    }

    $posts = R::findAll("posts", ' ORDER BY id DESC ');

    include(ROOT . "templates/head.tpl");
    include(ROOT . "templates/header.tpl");

    // var_dump($posts);
?>

<main class="page-content">
    <div class="container container-narrow">
        <div class="posts-wrapper">

            <?php
            // var_dump($_COOKIE['theme']);
               foreach ($posts as $post ) {
                    include(ROOT . 'templates/post-short.tpl');
               }
            ?>
            <!-- <article class="post">
                <div class="post__date">16.03.2025</div>
                <h2 class="post__title">Сила, заключённая в металле</h2>
                <div class="post__img-wrapper">
                    <img class="post__img no-picture" src="<?=HOST?>/assets/img/pictures/img1.jpg" alt="Post image">
                </div>
                <div class="post__text">
                    <p>
                        Некоторые автомобили созданы не просто для передвижения — они олицетворяют мощь, свободу и стиль. Этот мускулистый Dodge Challenger в бирюзовом цвете — настоящий символ американской автомобильной культуры. Его агрессивный силуэт, заниженная посадка и черные диски говорят сами за себя: это машина, которая требует дороги.
                    </p>
                </div>
                <div class="post__readmore">
                    <a class="link" href="post.php">Читать далее</a>
                </div>
                <div class="post__buttons">
                    <a class="btn btn--secondary" href="<?=HOST?>/edit-post.php">Редактировать</a>
                    <a class="btn btn--secondary" href="<?=HOST?>/delete-post.php">Удалить</a>
                </div>
            </article> -->

            <article class="post">
                <div class="post__date">14.03.2025</div>
                <div class="post__text post__text--lg">
                    <p>
                        Тихий плеск волны,<br> шёпот ветра в камышах —<br>время не спешит. 🌿✨
                    </p>
                </div>
                <div class="post__buttons">
                    <a class="btn btn--secondary" href="edit-post.php">Редактировать</a>
                    <a class="btn btn--secondary" href="delete-post.php">Удалить</a>
                </div>

            </article>
        </div>
    </div>
</main>

<?php
    include(ROOT . "templates/footer.tpl");
?>
	