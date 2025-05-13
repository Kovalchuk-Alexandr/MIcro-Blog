<?php
    require("config.php");
	require("db.php");
    require "functions/all.php";

	// Если не админ, возвращаем на главную, 
	// чтобы нельзя было войти через http://localhost:443/edit-post.php?id=80
	if (!is_admin()) {
		header('Location: ' . HOST);
		exit;
	}

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

	// Если форма отправлена и в ней есть 'delete-post'
	if (isset($_POST['delete-post'])) {
		// Удаляем пост и возвращаемся на главную
		R::trash($post);

		// Удаляем фото на локальном диске
		deleteFile($post['cover_name']);
		
		header("Location: " . HOST);
        exit;
	}

    include(ROOT . "templates/head.tpl");
    include(ROOT . "templates/header.tpl");
?>

<main class="page-content">
	<div class="container container-narrow">
		<form action="" class="form" method="POST">
			<h2 class="form__title">Удалить пост?</h2>

			<?php
			   include(ROOT . 'templates/post-delete-preview.tpl') ;
			?>

			<div class="form__btns-wrapper">
				<button class="btn btn--lg" name="delete-post">Удалить</button>
				<a class="btn btn--lg btn--secondary" href="<?=HOST?>">Отмена</a>
			</div>
		</form>
	</div>
</main>

<?php
    include(ROOT . "templates/footer.tpl");
?>