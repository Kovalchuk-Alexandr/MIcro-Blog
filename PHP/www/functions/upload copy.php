<?php
   
   function upload_photo() {
    // Загрузка фото

    // Ф. возвращает либо массив с сообщением об ошибке либо строку с именем фото
        // Если ошибка происходит, возвращаем массив со строкой ошибки
        // Проверка на ошибки при загрузке файла
        if ($_FILES['cover']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Ошибка при загрузке файла";
        }

        // Проверка на тип файла
        $file_type =  mime_content_type($_FILES['cover']['tmp_name']);
        // Если не найдено (недопустимый формат)
        if (!in_array($file_type, $allowed_file_types)) {
            $errors[] = "Недопустимый тип файла. Загрузите изображение в формате jpg, png, gif, webp, avif";
        }

        // Проверка на расширение файла
        $extension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        // Если не найдено (недопустимый формат)
        if (!in_array($extension, $allowed_extensions)) {
            $errors[] = "Недопустимое расширение файла. Загрузите изображение в формате jpg, png, gif, webp, avif";
        }

    echo "file_type: " . $file_type . "<br>";
    echo "extension: " . $extension . "<br>";

        // Проверка на размер файла
        if ($_FILES['cover']['size'] > MAX_UPLOAD_FILE_SIZE) {
            $errors[] = "Файл слишком большой. Максимальный размер 10Mb";
            return $errors;
        }

        // Меняем расширение
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        $file_name = uniqid() .'.'. $extension;	
        $upload_path = ROOT . 'data/covers/' . $file_name;

        // Если не было ошибок, финальная проверка перед перемещением
        if (empty($errors)) {
            if (!move_uploaded_file($_FILES['cover']['tmp_name'], $upload_path)) {
                $errors[] = "Ошибка сохранения файл";
            } else {
                return $file_name;
            }
        }
   }
?>