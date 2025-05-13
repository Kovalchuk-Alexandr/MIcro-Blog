<?php
    require("config.php");
    require("db.php");
    require "functions/all.php";

    // var_dump($_GET);
    // Проверяем, есть ли 'id' в GET-массиве, и это число
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
         $post = R::load("posts", $_GET["id"]);

        // Если такой пост с 'id' есть, но пустой - на главную
        if ($post['id'] == 0) {
            header("Location: " . HOST);
            exit;
        }
    } else {
        // Если нет, перекидываем на главную
        header("Location: " . HOST);
        exit;
    }


    include(ROOT . "templates/head.tpl");
    include(ROOT . "templates/header.tpl");
?>

<main class="page-content">
    <div class="container container-narrow">
        <div class="posts-wrapper">
            <article class="post">
                <div class="post__date"><?php echo date('d.m.Y', strtotime($post['created_at']))  ?></div>

                <?php if(!empty($post['title'])): ?>
                    <h1 class="post__title"><?= $post['title'] ?></h1>
                <?php endif;?>

                <?php if(!empty($post['cover_name'])): ?>
                    <div class="post__img-wrapper">
                        <img class="post__img no-picture" src="<?=HOST?>/data/covers/<?= $post['cover_name'] ?>" alt="Post image">
                    </div>
                <?php endif;?>
                <!-- <div class="post__img-wrapper">
                    <picture>
                    <source srcset="<?=HOST?>/assets/img/pictures/img1.avif" type="image/avif"></source>
                    <source srcset="<?=HOST?>/assets/img/pictures/img1.webp" type="image/webp"></source>
                    <img class="post__img " src="<?=HOST?>/assets/img/pictures/img1.jpg" alt="Post image">
                    </picture>
                </div> -->

                <?php if(!empty($post['content'])): ?>
                    <div class="post__text post__text--full">
                        <p>
                            <?= $post['content']?>
                        </p>

                        <h2>Дом у озера — мечта об уединении</h2>

                        <p>Представьте, как вы просыпаетесь в деревянном доме у самого озера. За окном тишина, только легкие волны касаются берега, а в воздухе витает свежесть утреннего леса. Выйти на балкон с чашкой кофе, вдохнуть этот воздух полной грудью — что может быть лучше?</p>
                        <p>Сад у воды — это место, где можно забыть обо всем и просто наслаждаться моментом. Книга в руках, неспешные разговоры или отдых в шезлонге с видом на зеркальную гладь озера. Здесь природа диктует свой ритм жизни, позволяя сбросить напряжение городской суеты.</p>
                        <p>Хотели бы вы провести здесь несколько дней наедине с природой? 🌿✨</p>
                    </div>
                <?php endif;?>

                <!-- <div class="post__text post__text--full">
                    <p>
                        Есть места, где время словно замедляет свой бег. Терраса с панорамным видом на озеро, высокие горы, окутанные легкой дымкой, и утренний воздух, наполненный ароматами природы. Здесь нет суеты, только тишина, покой и ощущение гармонии.
                    </p>
                    <p>
                        Представьте, как вы выходите босиком на прохладную плитку, завариваете чашку свежего кофе и садитесь в шезлонг, наслаждаясь неспешным началом дня. Такой отдых пробуждает внутреннее вдохновение и напоминает о простых радостях жизни.
                    </p>
                    <p>
                        Где вы хотели бы остановиться, чтобы почувствовать настоящий дзен? 🌿✨
                    </p>

                    <h2>Дом у озера — мечта об уединении</h2>

                    <p>Представьте, как вы просыпаетесь в деревянном доме у самого озера. За окном тишина, только легкие волны касаются берега, а в воздухе витает свежесть утреннего леса. Выйти на балкон с чашкой кофе, вдохнуть этот воздух полной грудью — что может быть лучше?</p>
                    <p>Сад у воды — это место, где можно забыть обо всем и просто наслаждаться моментом. Книга в руках, неспешные разговоры или отдых в шезлонге с видом на зеркальную гладь озера. Здесь природа диктует свой ритм жизни, позволяя сбросить напряжение городской суеты.</p>
                    <p>Хотели бы вы провести здесь несколько дней наедине с природой? 🌿✨</p>
                </div> -->

                <div class="post__readmore">
                    <a href="<?=HOST?>">На главную</a>
                </div>

                 <!-- Только админу позволено удалять и редактировать -->
                <?php if(is_admin()): ?>
                    <div class="post__buttons">
                        <a class="btn btn--secondary" href="<?=HOST?>/edit-post.php?id=<?=$post['id'] ?>">Редактировать</a>
                        <a class="btn btn--secondary" href="<?=HOST?>/delete-post.php?id=<?=$post['id'] ?>">Удалить</a>
                    </div>
                <?php endif;?>
            </article>
				
			</div>
		</div>
</main>

<?php
    include(ROOT . "templates/footer.tpl");
?>