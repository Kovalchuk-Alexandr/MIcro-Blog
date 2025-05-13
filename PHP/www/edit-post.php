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

	// Если форма отправлена и она не пустая
	if (!empty($_POST)) {
		// Проверяем, были ли ошибки
		if(empty($_FILES['cover']['tmp_name']) && empty($_POST['content'])) {
			$errors[] = "Пост обязательно должен содержать текст или обложку!";
		}

		// Если ошибок нет
		if (empty($errors)) {
			// Работа с обложкой
			$coverName = $post['cover_name'];

			// Проверка чек-бокса на нажатие
			if (isset($_POST['deleteCover']) && $_POST['deleteCover'] == 'on') {
				// Удаляем старое фото на локальном диске, если есть
				deleteFile($coverName);

				$coverName = null;
			}

			// Проверяем, есть ли вообще файл
			if (!empty($_FILES['cover']['tmp_name'])) {

			global $allowed_resize_file_types;
				// Проверка загруженной фотографии на ошибки, размер, тип файла
				$checkdResult = checkPhotoBeforeUpload();

				// Если вернулся массив, значит - это сообщение об ошибке
				if (is_array($checkdResult)) {
					$errors = $checkdResult;
				// Если вернулась строка, значит имя файла
				} elseif ($checkdResult == true) {
					// Откуда, временное размещение после отправки формы
					$sourcePath = $_FILES['cover']['tmp_name'];

					// Куда - путь внутри сайта
					$extension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
					if ($extension === 'jpeg') {$extension = 'jpg';}

					$file_name = uniqid() .'.'. $extension;	
					$dest_dir = ROOT . 'data/covers/';
					$upload_path = $upload_dir . $file_name;
					$dest_path = $dest_dir . $file_name;

					// Проверка на тип файла
					$file_type =  mime_content_type($sourcePath);
					// Проверяем, есть ли директорий назначения...
					createDirectoryIfNotExist($dest_dir);
					// Если найдено - ресайзим
					if (in_array($file_type, $allowed_resize_file_types)) {
						// Ресайз и сохранение обложки на сайт
						resizeImageByWidth($sourcePath, $dest_path, 600);
					} else {
						if (!move_uploaded_file($_FILES['cover']['tmp_name'], $dest_path)) {
							$errors[] = "Ошибка сохранения файл";
						} 
					}

					// Удаляем старое фото на локальном диске, если есть
					deleteFile($coverName);

					$coverName = $file_name;
					// echo 'cover name: ' . $coverName;
					// exit;
				}

			}

			// Создание поста
			$post->title = trim($_POST["title"]);
			$post->content = trim($_POST["content"]);
			// $post->created_at = date('Y-m-d H:i:s');
			$post->cover_name = $coverName;

			$id = R::store($post);
		}


		
		// Если такой файл существует, удаляем локально
		// 	if (!unlink($dest_path)) {
		// 		$errors[] = "Ошибка удаления локального файла";
		// 	}

		// header("Location: " . HOST);
        // exit;
	}

    include(ROOT . "templates/head.tpl");
    include(ROOT . "templates/header.tpl");
?>

<main class="page-content">
	<div class="container container-narrow">
		<form action="" class="form" enctype="multipart/form-data" method="POST">
			<h2 class="form__title">Редактировать</h2>

			<?php
			   if(isset($errors) && !empty($errors)) {
					foreach ($errors as $error) {
						echo"<div class='error'> $error</div>";
					}
			   }

			   if(isset($id)) {
					echo"<div class='success'>Пост с ID: $id успешно обнавлен</div>";
			   }
			?>

			<!-- <pre>
				<?=print_r($_POST)?>
			</pre> -->

			<label class="fieldset">
				<span class="label">Название</span>
				<input class="input" type="text" name="title" value="<?= $post['title'] ?>">
			</label>

			<label class="fieldset">
				<span class="label" >Содержание</span>
				<textarea class="textarea" name="content"><?= $post['content'] ?></textarea>
			</label>

			<fieldset class="fieldset">
				<span class="label" >Обложка</span>
				<?php if(!empty($post['cover_name'])): ?>
					<div class="fieldset__cover-wrapper">
						<img class="fieldset__cover no-picture" src="<?=HOST?>/data/covers/<?= $post['cover_name'] ?>" alt="Post cover">
					</div>
				<?php endif;?>

				<label class="fieldset fieldset--checkbox">
					<input class="input input--checkbox" type="checkbox" name="deleteCover">
					Удалить обложку
				</label>
				
				<input class="btn btn--secondary btn--file" type="file" name="cover">
			</fieldset>

			<div class="form__btns-wrapper">
				<button class="btn btn--lg" >Обновить</button>
				<a class="btn btn--lg btn--secondary" href="<?=HOST?>">Отмена</a>
			</div>
		</form>
	</div>
</main>

<?php
    include(ROOT . "templates/footer.tpl");
?>