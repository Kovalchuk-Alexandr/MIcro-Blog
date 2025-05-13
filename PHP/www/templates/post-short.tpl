<article class="post">
    <!-- <div class="post__date"><?= $post['created_at'] ?></div> -->
    <div class="post__date"><?php echo date('d.m.Y', strtotime($post['created_at']))  ?></div>

    <?php if(!empty($post['title'])): ?>
        <h2 class="post__title"><?= $post['title'] ?></h2>
    <?php endif;?>
       
    
    <?php if(!empty($post['cover_name'])): ?>
        <div class="post__img-wrapper">
            <img class="post__img no-picture" src="<?=HOST?>/data/covers/<?= $post['cover_name'] ?>" alt="Post image">
        </div>
    <?php endif;?>

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
    
    <!-- Только админу позволено удалять и редактировать -->
    <?php if(is_admin()): ?>
        <div class="post__buttons">
            <a class="btn btn--secondary" href="<?=HOST?>/edit-post.php?id=<?=$post['id'] ?>">Редактировать</a>
            <a class="btn btn--secondary" href="<?=HOST?>/delete-post.php?id=<?=$post['id'] ?>">Удалить</a>
        </div>
    <?php endif;?>
</article>