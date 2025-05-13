<?php

function resizeAndCropImage($sourcePath, $destPath, $newWidth, $newHeight)
{
	// Определяем тип изображения
	$imageInfo = getimagesize($sourcePath);
	$mime = $imageInfo['mime'];

	switch ($mime) {
		case 'image/jpeg':
			$sourceImage = imagecreatefromjpeg($sourcePath);
			break;
		case 'image/png':
			$sourceImage = imagecreatefrompng($sourcePath);
			break;
		case 'image/gif':
			$sourceImage = imagecreatefromgif($sourcePath);
			break;
		default:
			throw new Exception('Неподдерживаемый формат изображения');
	}

	// Исходные размеры
	list($origWidth, $origHeight) = $imageInfo;

	// Вычисляем соотношение сторон
	$srcRatio = $origWidth / $origHeight;
	$destRatio = $newWidth / $newHeight;

	if ($srcRatio > $destRatio) {
		// Оригинал шире, чем нужно -> ограничиваем по высоте
		$cropHeight = $origHeight;
		$cropWidth = $origHeight * $destRatio;
		$srcX = ($origWidth - $cropWidth) / 2;
		$srcY = 0;
	} else {
		// Оригинал выше, чем нужно -> ограничиваем по ширине
		$cropWidth = $origWidth;
		$cropHeight = $origWidth / $destRatio;
		$srcX = 0;
		$srcY = ($origHeight - $cropHeight) / 2;
	}

	// Создаём новое изображение
	$resizedImage = imagecreatetruecolor($newWidth, $newHeight);

	// Поддержка прозрачности для PNG и GIF
	if ($mime == 'image/png' || $mime == 'image/gif') {
		imagealphablending($resizedImage, false);
		imagesavealpha($resizedImage, true);
		$transparent = imagecolorallocatealpha($resizedImage, 0, 0, 0, 127);
		imagefill($resizedImage, 0, 0, $transparent);
	}

	// Обрезаем и ресайзим
	imagecopyresampled(
		$resizedImage,
		$sourceImage,
		0,
		0,  // Координаты в новом изображении
		$srcX,
		$srcY, // Координаты начала кропа в исходном изображении
		$newWidth,
		$newHeight, // Размеры нового изображения
		$cropWidth,
		$cropHeight // Размеры кропа
	);

	// Сохраняем результат
	switch ($mime) {
		case 'image/jpeg':
			imagejpeg($resizedImage, $destPath, 90);
			break;
		case 'image/png':
			imagepng($resizedImage, $destPath);
			break;
		case 'image/gif':
			imagegif($resizedImage, $destPath);
			break;
	}

	// Освобождаем память
	imagedestroy($sourceImage);
	imagedestroy($resizedImage);

	return true;
}

function resizeImageByWidth($sourcePath, $destPath, $newWidth)
{
	// Определяем тип изображения
	$imageInfo = getimagesize($sourcePath);
	$mime = $imageInfo['mime'];

	switch ($mime) {
		case 'image/jpeg':
			$sourceImage = imagecreatefromjpeg($sourcePath);
			break;
		case 'image/png':
			$sourceImage = imagecreatefrompng($sourcePath);
			break;
		case 'image/gif':
			$sourceImage = imagecreatefromgif($sourcePath);
			break;
		default:
			throw new Exception('Неподдерживаемый формат изображения');
	}

	// Исходные размеры
	list($origWidth, $origHeight) = $imageInfo;

	// Вычисляем новую высоту, сохраняя пропорции
	$newHeight = intval(($newWidth / $origWidth) * $origHeight);

	// Создаём новое изображение с новыми размерами
	$resizedImage = imagecreatetruecolor($newWidth, $newHeight);

	// Поддержка прозрачности для PNG и GIF
	if ($mime == 'image/png' || $mime == 'image/gif') {
		imagealphablending($resizedImage, false);
		imagesavealpha($resizedImage, true);
		$transparent = imagecolorallocatealpha($resizedImage, 0, 0, 0, 127);
		imagefill($resizedImage, 0, 0, $transparent);
	}

	// Ресайз изображения
	imagecopyresampled(
		$resizedImage,
		$sourceImage,
		0,
		0,  // Координаты в новом изображении
		0,
		0, // Координаты в исходном изображении
		$newWidth,
		$newHeight, // Новые размеры
		$origWidth,
		$origHeight // Исходные размеры
	);

	// Сохраняем результат
	switch ($mime) {
		case 'image/jpeg':
			imagejpeg($resizedImage, $destPath, 90);
			break;
		case 'image/png':
			imagepng($resizedImage, $destPath);
			break;
		case 'image/gif':
			imagegif($resizedImage, $destPath);
			break;
	}

	// Освобождаем память
	imagedestroy($sourceImage);
	imagedestroy($resizedImage);

	return true;
}
