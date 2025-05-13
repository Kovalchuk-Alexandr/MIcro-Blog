<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>My Blog | Main</title>
    <link rel="stylesheet" href="<?=HOST?>/assets/css/style.min.css">
    <link rel="stylesheet" href="<?=HOST?>/assets/css/addon.css">

	<link rel="icon" type="image/x-icon" href="<?=HOST?>/assets/img/favicons/favicon.svg">
	<link rel="apple-touch-icon" sizes="180x180" href="<?=HOST?>/assets/img/favicons/apple-touch-icon.webp">
</head>

<!-- Проверяем, какая тема в GET -->
<?php
$className = '';
if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
	$className .= 'dark';
}

?>
	
<body class="<?=$className?>">