<article class="post post--preview">
    <!-- <div class="post__date">16.03.2025</div>
    <h2 class="post__title">Сила, заключённая в металле</h2> -->
    <div class="post__date"><?php echo date('d.m.Y', strtotime($post['created_at']))  ?></div>

    <?php if(!empty($post['title'])): ?>
        <h2 class="post__title"><?= $post['title'] ?></h2>
    <?php endif;?>

    <?php if(!empty($post['cover_name'])): ?>
        <div class="post__img-wrapper">
            <img class="post__img no-picture" src="<?=HOST?>/data/covers/<?= $post['cover_name'] ?>" alt="Post image">
        </div>
    <?php endif;?>

    <!-- <div class="post__img-wrapper">
        <img class="post__img no-picture" src="<?=HOST?>/assets/img/pictures/img1.jpg" alt="Post image">
    </div> -->

    <?php if(!empty($post['content'])): ?>
        <div class="post__text">
            <p>
                <!-- Обрезаем контент до последнего пробела < 400 символов -->
                <?php echo getExcerpt($post['content'], 400, 340)?>
            </p>
        </div>
    <?php endif;?>

    <!-- Если есть что читать (content > 400 символов), выводим надпись 'Читать далее' -->
    <?php if(mb_strlen($post['content'],"UTF-8") > 400): ?>
        <div class="post__readmore">
            <a class="link" href="post.php?id=<?=$post['id'] ?>">Читать далее</a>
        </div>
    <?php endif;?>


    <!-- <div class="post__text">
        <p>
            Некоторые автомобили созданы не просто для передвижения — они олицетворяют мощь, свободу и стиль. Этот мускулистый Dodge Challenger в бирюзовом цвете — настоящий символ американской автомобильной культуры. Его агрессивный силуэт, заниженная посадка и черные диски говорят сами за себя: это машина, которая требует дороги.
        </p>
    </div> -->
    
    <!-- <div class="post__readmore">
        <a href="post.html">Читать далее</a>
    </div> -->
    <!-- <div class="post__buttons">
        <a class="btn btn--secondary" href="edit-post.html">Редактировать</a>
        <a class="btn btn--secondary" href="delete-post.html">Удалить</a>
    </div> -->
</article>