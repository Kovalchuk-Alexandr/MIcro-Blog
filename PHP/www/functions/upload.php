<?php
    function createDirectoryIfNotExist($path) {
    // Проверяем, есть ли директорий назначения...
        if (!is_dir($path)) {
            // если нет, создаем
            mkdir($path, 0777, true);
        }
   }
   
   function checkPhotoBeforeUpload() {
        global $allowed_file_types, $allowed_extensions, $upload_dir;

        // Ф. возвращает либо массив с сообщением об ошибке либо строку с именем фото
        // Если ошибка происходит, возвращаем массив со строкой ошибки
        // Проверка на ошибки при загрузке файла
        if ($_FILES['cover']['error'] !== UPLOAD_ERR_OK) {
            return ["Ошибка при загрузке файла"];
        }

        // Проверка на тип файла
        $file_type =  mime_content_type($_FILES['cover']['tmp_name']);
        // Если не найдено (недопустимый формат)
        if (!in_array($file_type, $allowed_file_types)) {
            return ["Недопустимый тип файла. Загрузите изображение в формате jpg, png, gif, webp, avif"];
        }

        // Проверка на расширение файла
        $extension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        // Если не найдено (недопустимый формат)
        if (!in_array($extension, $allowed_extensions)) {
            return ["Недопустимое расширение файла. Загрузите изображение в формате jpg, png, gif, webp, avif"];
        }

    // echo "file_type: " . $file_type . "<br>";
    // echo "extension: " . $extension . "<br>";

        // Проверка на размер файла
        if ($_FILES['cover']['size'] > MAX_UPLOAD_FILE_SIZE) {
            return ["Файл слишком большой. Максимальный размер 10Mb"];
        }

        // Меняем расширение
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        $upload_dir = ROOT . 'data/covers/';
        
        // Проверяем, есть ли директорий назначения...
        createDirectoryIfNotExist($upload_dir);

        return true;
   }
   function upload_photo() {
        global $allowed_file_types, $allowed_extensions, $errors;

        // Проверка на расширение файла
        $extension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        // Если не найдено (недопустимый формат)
        if (!in_array($extension, $allowed_extensions)) {
            return ["Недопустимое расширение файла. Загрузите изображение в формате jpg, png, gif, webp, avif"];
        }

        // Меняем расширение
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        $file_name = uniqid() .'.'. $extension;	
        $upload_dir = ROOT . 'data/covers/';
        $dest_dir = ROOT . 'data/covers/thumb';
        
        // Проверяем, есть ли директорий назначения...
        createDirectoryIfNotExist($upload_dir);
        
        $upload_path = $upload_dir . $file_name;

        // Если не было ошибок, финальная проверка перед перемещением
        if (empty($errors)) {
            if (!move_uploaded_file($_FILES['cover']['tmp_name'], $upload_path)) {
                return ["Ошибка сохранения файл"];
            } else {
                return $file_name;
            }
        }
   }

    //  Удаление локального файла
    function deleteFile($file){
        $dest_dir = ROOT . 'data/covers/';
        $dest_path = $dest_dir . $file;
        // Удаляем файл на локальном диске, если есть
        if (is_file($dest_path)) {
            unlink($dest_path);
        }
    }
   function upload_photo_copy() {
        global $allowed_file_types, $allowed_extensions;

        // Ф. возвращает либо массив с сообщением об ошибке либо строку с именем фото
        // Если ошибка происходит, возвращаем массив со строкой ошибки
        // Проверка на ошибки при загрузке файла
        if ($_FILES['cover']['error'] !== UPLOAD_ERR_OK) {
            return ["Ошибка при загрузке файла"];
        }

        // Проверка на тип файла
        $file_type =  mime_content_type($_FILES['cover']['tmp_name']);
        // Если не найдено (недопустимый формат)
        if (!in_array($file_type, $allowed_file_types)) {
            return ["Недопустимый тип файла. Загрузите изображение в формате jpg, png, gif, webp, avif"];
        }

        // Проверка на расширение файла
        $extension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        // Если не найдено (недопустимый формат)
        if (!in_array($extension, $allowed_extensions)) {
            return ["Недопустимое расширение файла. Загрузите изображение в формате jpg, png, gif, webp, avif"];
        }

    // echo "file_type: " . $file_type . "<br>";
    // echo "extension: " . $extension . "<br>";

        // Проверка на размер файла
        if ($_FILES['cover']['size'] > MAX_UPLOAD_FILE_SIZE) {
            return ["Файл слишком большой. Максимальный размер 10Mb"];
        }

        // Меняем расширение
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        $file_name = uniqid() .'.'. $extension;	
        $upload_dir = ROOT . 'data/covers/';
        $dest_dir = ROOT . 'data/covers/thumb';
        
        // Проверяем, есть ли директорий назначения...
        createDirectoryIfNotExist($upload_dir);
        
        $upload_path = $upload_dir . $file_name;

        // Если не было ошибок, финальная проверка перед перемещением
        if (empty($errors)) {
            if (!move_uploaded_file($_FILES['cover']['tmp_name'], $upload_path)) {
                return ["Ошибка сохранения файл"];
            } else {
                return $file_name;
            }
        }
   }
