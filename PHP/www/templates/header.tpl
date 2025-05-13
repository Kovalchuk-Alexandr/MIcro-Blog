<header class="header">
    <div class="container">
        <div class="header__row">
            <div class="header__logo">
                <a class="logo__link" href="<?=HOST?>/../index.php">MY BLOG</a>
            </div>

            <div class="header__btns">

                <?php if(is_admin()): ?>
                    <a class="btn " href="<?=HOST?>/create-post.php">Добавить пост</a>
                    <a class="btn " href="<?=HOST?>/logout.php">Выход</a>
                <?php else: ?>
                    <a class="btn " href="<?=HOST?>/login.php">Вход</a>
                <?php endif;?>

                <!-- Сохраняем тему в куки -->
                <?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark'): ?>
                    <a class="btn toggleDarkModeBtn" href="<?=HOST?>/index.php?theme=light">☀️</a>
                <? else: ?>
                    <a class="btn toggleDarkModeBtn" href="<?=HOST?>/index.php?theme=dark">🌘</a>
                <? endif; ?>
            </div>

            <!-- Mobile button open -->
            <button class="mobile-nav-btn">
                <div class="mobile-nav-btn__icon">
                    <!-- Если используются разные кнопки для откр/закр -->
                    <!-- <img class="nav-img" src="./img/ui/menu_right.svg" alt="Menu button" > -->
                </div>
            </button>
        </div>
    </div>
</header>
	
	<!-- ======= Мобильная навигация  ============================ -->
<div class="mobile-nav ">
	<div class="nav__btn-set">
        <?php if(is_admin()): ?>
            <a class="btn " href="<?=HOST?>/create-post.php">Добавить пост</a>
            <a class="btn " href="<?=HOST?>/logout.php">Выход</a>
        <?php else: ?>
            <a class="btn " href="<?=HOST?>/login.php">Вход</a>
        <?php endif;?>

        <!-- Сохраняем тему в куки -->
        <?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark'): ?>
            <a class="btn toggleDarkModeBtn" href="<?=HOST?>/index.php?theme=light">☀️</a>
        <? else: ?>
            <a class="btn toggleDarkModeBtn" href="<?=HOST?>/index.php?theme=dark">🌘</a>
        <? endif; ?>
		<!-- <a class="btn " href="<?=HOST?>/create-post.php">Добавить пост</a>
        <a class="btn " href="<?=HOST?>/login.php">Вход</a> 
		<a class="btn toggleDarkModeBtn" href="<?=HOST?>/index.php?theme=light">☀️</a>
		<a class="btn toggleDarkModeBtn" href="<?=HOST?>/index.php?theme=light">🌘</a>-->
	</div>
	
</div>

<!-- ======= Fade для мобильной навигации  =================== -->
<div class="mobile-nav-fade"></div>