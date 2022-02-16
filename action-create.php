<?php 

	$mysqli = new mysqli("localhost", "mysql", "mysql", "course");
	$mysqli->set_charset("utf8");	
	
	$msg_box = ""; // в этой переменной будем хранить сообщения формы
	$errors = array(); // контейнер для ошибок
	// проверяем корректность полей
	if($_POST['name'] == "") {
		$errors[] = 'Заполните поле: ФИО';
	}
	/*elseif(strlen($_POST['phone']) != 11) {	 
		$errors[] = 'Заполните поле: телефон';
	}*/
	elseif($_POST['email'] == "") { 
		$errors[] = 'Заполните поле: почта';
	}
	//!preg_match("|^[A-Za-zА-Яа-яЁё0-9_.-]{1,})@([A-Za-z]{1,}).([A-Za-z]{2,8}|",$_POST['email']) 
	/*elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Неверная почта!";
	}*/
	elseif($_POST['city'] == "") {   
		$errors[] = 'Заполните поле: город';
	}
	elseif($_POST['address'] == "") {   
		$errors[] = 'Заполните поле: адрес';
	}
	elseif($_POST['post'] == "") {   
		$errors[] = 'Заполните поле: должность';
	}
	elseif($_POST['market'] == "") {   
		$errors[] = 'Заполните поле: магазин';
	}
	elseif($_POST['section'] == "") {   
		$errors[] = 'Заполните поле: отдел';
	}
	elseif($_POST['date'] == "") {   
		$errors[] = 'Заполните поле: дату устройства';
	}
	else {
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$post = $_POST['post'];
		$market = $_POST['market'];
		$section = $_POST['section'];
		$date = $_POST['date'];

		$result_set = $mysqli->query("SELECT `idCity` FROM `cities` WHERE `nameCity` = '$city'");
		$data = $result_set->fetch_assoc();
		$city = $data['idCity'];

		$result_set = $mysqli->query("SELECT `idPost` FROM `posts` WHERE `namePost` = '$post'");
		$data = $result_set->fetch_assoc();
		$post = $data['idPost'];

		$result_set = $mysqli->query("SELECT `idMarket` FROM `markets` WHERE `nameMarket` = '$market'");
		$data = $result_set->fetch_assoc();
		$market = $data['idMarket'];

		$result_set = $mysqli->query("SELECT `idSection` FROM `sections` WHERE `nameSection` = '$section'");
		$data = $result_set->fetch_assoc();
		$section = $data['idSection'];
	}

	// если форма без ошибок
	if(empty($errors)){		
		$sql = "INSERT INTO `people`(`namePeople`, `phone`, `email`, `photo`, `idCity`, `address`, `idPost`, `idMarket`, `idSection`, `dateEmployment`) VALUES ('$name', '$phone', '$email', NULL, '$city', '$address', '$post', '$market', '$section', '$date')";
		if(mysqli_query($mysqli, $sql)){
		    $msg_box = "Записи успешно вставлены.";
		} else{
		    $msg_box = "ERROR: Не удалось выполнить $sql. " . mysqli_error($mysqli);
		}
	}
	else {
		$msg_box = $errors;
	}

	// делаем ответ на клиентскую часть в формате JSON
	echo json_encode(array(
		'result' => $msg_box
	));

?>