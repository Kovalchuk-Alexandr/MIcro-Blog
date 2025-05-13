<?php
    require("config.php");
	require("db.php");
    require "functions/all.php";

	// Если форма отправлена и она не пустая
	if (!empty($_POST)) {

		// Проверяем на заполненность полей
		if(empty($_POST['username'])) $errors[] = "Введите имя пользователя!";
		if(empty($_POST['password'])) $errors[] = "Введите пароль!";
		

		// Если ошибок нет
		if (empty($errors)) {
			$user = R::findOne("users", ' username LIKE ? ', [$_POST["username"]]);

			// Проверка пароля, если пользователь найден
			if ($user) {
				if ($user['password'] == $_POST["password"]) {
					// Пароль верный
					$_SESSION['username'] = $user['username'];
					$_SESSION['role'] = $user['role'];
					header('Location: ' . HOST);
					exit;
				} else {
					// Пароль не верный
					$errors[] = "Неверные данные для входа";

				}
			} else {
				$errors[] = "Пользователь не найден";
			}
		}
		
	}

    include(ROOT . "templates/head.tpl");
    include(ROOT . "templates/header.tpl");
?>

<main class="page-content">
	<div class="container container-narrow">
		<form action="" class="form" method="POST" enctype="multipart/form-data">
			<h2 class="form__title">Вход</h2>

			<?php
			   if(isset($errors) && !empty($errors)) {
					foreach ($errors as $error) {
						echo"<div class='error'> $error</div>";
					}
			   }

			//    if(isset($id)) {
			// 		echo"<div class='success'>Пост с ID: $id успешно создан</div>";
			//    }
			?>

			<!-- <pre>
				<?=print_r($_POST)?>
			</pre> -->

			<label class="fieldset">
				<span class="label" for="email">User</span>
				<input class="input" type="text" name="username" id="email">
			</label>

			<label class="fieldset">
				<span class="label" for="pwd">Password</span>
				<input class="input" type="password" name="password" id="pwd">
			</label>

			<button class="btn btn--lg" type="submit">Войти</button>
		</form>
	</div>
</main>

<?php
    include(ROOT . "templates/footer.tpl");
?>