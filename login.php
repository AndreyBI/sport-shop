<?php	
 	session_start();
	// Получаем данные
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	// СОздаем соединение
	$mysqli = new mysqli("localhost", "mysql", "mysql", "course");
	$mysqli->set_charset("utf8");

	$result_set = $mysqli->query("SELECT `idPeople`, `phone` FROM `people` WHERE `email` = '$email'");
	$data = $result_set->fetch_assoc();
	if (!$data) {
        $msg_box = '<p class="error-text">Неверные почта и/или номер телефона!</p>';
    } else {
        if ($phone == $data['phone']) {
            $_SESSION['user_id'] = $data['idPeople'];
        } else {
            $msg_box ='<p class="error-text">Неверные почта и/или номер телефона!</p>';
        }
    }

	$mysqli->close();

	// делаем ответ на клиентскую часть в формате JSON
	echo json_encode(array(
		'result' => $msg_box
	));
?>