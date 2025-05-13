<?php
   require ROOT . "libs/rb-mysql.php";
   // echo"DB_HOST: " . DB_HOST ."<br>";
	// echo"DB_NAME: " . DB_NAME ."<br>";
	// echo"DB_USER: " . DB_USER ."<br>";
	// echo"DB_PASS: " . DB_PASS ."<br>";

	// var_dump($_SERVER) ;
   
   // Соединение с БД
   R::setup('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);


	// Подключаемся к БД.
	// R::setup( 'mysql:host=database;dbname=microblog','root', 'tiger' ); 
	// R::setup( 'mysql:host=127.0.0.1;dbname=redbean','login', 'password' ); 
	// Проверяем соединение с БД.
	if ( !R::testConnection() )
    {
        echo 'Нет соединения с БД!<br>';
		 try{
			$db = new PDO('mysql:host=database;dbname=microblog','root','tiger');
			// $db = new PDO('mysql:host=HOSTNAME;dbname=DB_NAME','USERNAME','PASSWORD');
		} catch(PDOException $e){
			echo $e->getmessage();
		}
        // exit;
    }else{
        // echo 'Соединение установлено! <br>Всё прекрасно работает )<br>';
    }
?>
