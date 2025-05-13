<?php
    require("config.php");
	require("db.php");
	require("functions/all.php");

	// Если не админ, возвращаем на главную, 
	// чтобы нельзя было войти через http://localhost:443/edit-post.php?id=80
	if (!is_admin()) {
		header('Location: ' . HOST);
		exit;
	}

	if (!empty($_POST)) {
		// Проверяем, были ли ошибки
		if(empty($_FILES['cover']['tmp_name']) && empty($_POST['content'])) {
			$errors[] = "Пост обязательно должен содержать текст или обложку!";
		}

		// Если ошибок нет
		if (empty($errors)) {

			// Работа с обложкой
			$coverName = null;
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

					$coverName = $file_name;
					// echo 'cover name: ' . $coverName;
					// exit;
				}

				/*
				$uploadResult = upload_photo();

				// Если вернулся массив, значит - это сообщение об ошибке
				if (is_array($uploadResult)) {
					$errors = $uploadResult;
				// Если вернулась строка, значит имя файла
				} elseif (is_string($uploadResult)) {
					$coverName = $uploadResult;
					resizeAndCropImage($upload_dir, $dest_dir);
				}
					*/

			}

			// Создание поста
			$post = R::dispense("posts");
			$post->title = trim($_POST["title"]);
			$post->content = trim($_POST["content"]);
			$post->created_at = date('Y-m-d H:i:s');
			$post->cover_name = $coverName;

			$id = R::store($post);

			// После создания поста идем на главную
			header('Location: ' . HOST);
			exit;
		}
	}

    include(ROOT . "templates/head.tpl");
    include(ROOT . "templates/header.tpl");

	// Посмотреть массив отправленных данных
	// var_dump($_POST);
	// Посмотреть инфо отправленных файлов
	// var_dump($_FILES);
?>
<main class="page-content">
	<div class="container container-narrow">
		<!-- Чтобы данные отправлялись в форме через 'POST' нужен атрибут (enctype="multipart/form-data") -->
		<form action="" class="form" method="POST" enctype="multipart/form-data">
			<h2 class="form__title">Добавить запись</h2>

			<?php
			   if(isset($errors) && !empty($errors)) {
					foreach ($errors as $error) {
						echo"<div class='error'> $error</div>";
					}
			   }

			   if(isset($id)) {
					echo"<div class='success'>Пост с ID: $id успешно создан</div>";
			   }
			?>

			<label class="fieldset">
				<span class="label">Название</span>
				<input class="input" id="title" name="title">
			</label>

			<label class="fieldset">
				<span class="label" for="pwd">Содержание</span>
				<textarea class="textarea" name="content" id=""></textarea>
			</label>

			<fieldset class="fieldset">
				<span class="label" >Обложка</span>

				<!-- <label class="fieldset fieldset--checkbox">
					<input class="input input--checkbox" name="deleteCover">
					Удалить обложку
				</label> -->
				<input class="btn btn--secondary btn--file" id="coverInput" type="file" name="cover">

				<div class="cover-preview-wrapper">
					<img class="coverPreview" id="cover-preview" src="" alt="">
				</div>
			</fieldset>

			<button class="btn btn--lg" type="submit">Опубликовать</button>
		</form>
	</div>
</main>

<script>
	const previewUploadPostCover = () => {
		document.querySelector('#coverInput').addEventListener('change', function () {
			const file = this.files[0];

			if (file && file.type.startsWith('image/')) {
				const reader = new FileReader();
	
				reader.onload = ({
					target
				}) => {
					document.querySelector('#cover-preview').src = target.result;
					document.querySelector('.cover-preview-wrapper').style.display = 'block';

				};
				reader.readAsDataURL(file);
				
			}
		});
	}

	previewUploadPostCover();
</script>

<?php
    include(ROOT . "templates/footer.tpl");
?>