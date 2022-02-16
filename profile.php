<?php 
	session_start();

	if(!isset($_SESSION["user_id"])){
		// вывод "Session is set"; // в целях проверки
		header("Location: index.php");
		exit();
	} else {
    	$id = $_SESSION["user_id"];

		$mysqli = new mysqli("localhost", "mysql", "mysql", "course");
		$mysqli->set_charset("utf8");

		// Получаем данные сотрудника
		$result_set = $mysqli->query("SELECT * FROM `people` WHERE `idPeople`='$id'");
		$data = $result_set->fetch_assoc();

		if ($data['idPost'] == 6) {
			header("Location: profile-user.php");
			exit();
		}

		$result_set = $mysqli->query("SELECT `idPeople`, `namePeople` FROM `people`");
		$people = $result_set->fetch_assoc();

		// Узнаем название города сотрудника
		$num_city_worker = $data['idCity'];
		$cities_w =  $mysqli->query("SELECT `nameCity` FROM `cities` WHERE `idCity` = '$num_city_worker'");
		$city_w = $cities_w->fetch_assoc();

		// Узнаем должность сотрудника
		$num_post_worker = $data['idPost'];
		$posts = $mysqli->query("SELECT `namePost` FROM `posts` WHERE `idPost` = '$num_post_worker'");
		$post = $posts->fetch_assoc();

		// Наименование магазина
		$num_market_worker = $data['idMarket'];
		$markets = $mysqli->query("SELECT `nameMarket` FROM `markets` WHERE `idMarket` = '$num_market_worker'");
		$market = $markets->fetch_assoc();

		// Наименование отдела
		$num_section_worker = $data['idSection'];
		$sections = $mysqli->query("SELECT `nameSection` FROM `sections` WHERE `idSection` = '$num_section_worker'");
		$section = $sections->fetch_assoc();

		// Поставки в данный магазин
		$deliveries = $mysqli->query("SELECT * FROM `deliveries` WHERE `idMarket` = '$num_market_worker'");

		// Наличие товаров в данном магазине
		$existence = $mysqli->query("SELECT * FROM `existence` WHERE `idMarket` = '$num_market_worker'");

		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Личный кабинет</title>
	<link rel='icon' href='img/logo.png'>
	<link href="//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/styleProfile.css" />
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>	

	<!-- Добавление нового сотрудника -->
	<script type="text/javascript">
		function create(){
			// collecting data from the form
            var name 	 = $('#name').val();
            var phone    = $('#phone').val();
            phone = phone.replace(/[^\d]/g, '');
            var email 	 = $('#email').val();
            var city     = $('#cities').val();
            var address  = $('#address').val();
            var post     = $('#posts').val();
            var market   = $('#markets').val();
            var section  = $('#sections').val();
            var date     = $('#date').val();
            $('.btn-answer').disabled = true;
			// the information sent
			$.ajax({
				url: "action-create.php", // where we send it
				type: "post", // transmission method
				dataType: "json", // Type of data transfer
				data: { // what we send
                    "name":    name,
                    "phone":   phone,
					"email":   email,
                    "city":    city,
                    "address": address,
                    "post":    post,
                    "market":  market,
                    "section": section,
                    "date":    date,
				},
				// after receiving the server response
				success: function(data){
                    $('#error').html(data.result); // output the server response
				}
            });
		};
    </script>

    <!-- Live search -->
    <script type="text/javascript">
		function isEnglish(charCode) {
		    return (charCode >= 97 && charCode <= 122)
		        || (charCode >= 65 && charCode <= 90);
		}

    	function search(id, event) {
			var valOfInput = $('#' + id).val();
			var idOfInput = id;
			var code = event.key.charCodeAt(0);
			var display = '#display-' + idOfInput;
			if (valOfInput === "") {
		      $(display).html("");
		    }
		    else {
		      	$.ajax({
			        type: "POST", 
			        url: "action-search.php", 
			        data: {
			          	search: valOfInput,
			          	table: idOfInput
			        },
			        success: function(response) {
			          	$(display).html(response).show();
			        }
		    	});
		    }
    	}
    </script>

</head>
<body>
	<div id="roof">
		<div id="logo">
			<div class="logo_img">
	      		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.91 92.91" fill="currentColor">
	        		<path d="M51.6 92.51v-1.63c.01-5.24.03-10.48.02-15.72 0-2.5-.94-3.53-3.47-3.52-3.63.01-7.19-.44-10.64-1.56-10.43-3.37-15.76-10.83-17.06-21.46-.19-1.57-.28-3.17-.32-4.75-.05-2.2.86-3.27 3.04-3.63.6-.1 1.21-.08 1.82-.08l33.56-.01c1.86 0 2.47-.81 1.47-2.38-2.69-4.23-6.38-7.18-11.55-7.44-4.53-.22-9.08-.04-13.62-.04-3.03 0-3.8-.75-3.83-3.81-.03-3.42-.02-6.84-.02-10.25v-1.94c-7.96.63-19.36 16.97-20.46 28.2a36.48 36.48 0 0030.58 39.65v10.4a44.47 44.47 0 01-24.01-10.1C7.3 74.38 1.53 63.99.26 51.34-2.64 22.7 19.45 2.22 41.2.36v16.55c.01 2.6.56 3 3.21 3.22 3.02.25 6.07.53 9 1.24 10.29 2.5 17.18 10.4 18.45 20.9a49 49 0 01.32 5.72c0 1.88-1.06 2.91-2.94 3.06-.7.06-1.4.03-2.1.03-10.87 0-21.73.04-32.59-.05-2.1-.02-2.85 1.22-1.68 3.06 2.53 3.94 6.13 6.38 10.77 6.77 4.18.36 8.4.23 12.61.32.8.01 1.6-.03 2.4.05 2.34.25 3.43 1.4 3.45 3.76.04 3.98.01 7.96.02 11.94 0 .53.09 1.07.15 1.8a31.76 31.76 0 008.28-5.53c6.46-5.9 10.48-13.2 11.59-21.86 1.51-11.88-2.06-22.19-10.56-30.67-5.18-5.17-11.47-8.3-18.63-9.73-.42-.08-1.08-.48-1.1-.75-.07-3.26-.04-6.52-.04-9.8 20.01 1.8 39.98 18.95 41.05 43.93a46.21 46.21 0 01-41.25 48.2z"></path>
	      		</svg>
		    </div>
		    <p>Sport</p>
		</div>

		<div id="main_page">
			<a href="index.php">
				Главная
			</a>
		</div>

		<div id="catalog">
			<ul class="menu">
				<li><a href=#>
					Каталог
				</a>
					<ul class="submenu">
						<li>
							Каталог
						</li>
						<?
							$mysqli = new mysqli("localhost", "mysql", "mysql", "course");
							$mysqli->set_charset("utf8");

							// Список отделов
							$list_id_sections = $mysqli->query("SELECT `idSection` FROM `structure` WHERE `idMarket` = '$num_market_worker'");
							foreach($list_id_sections as $key => $value) {
								$id_section = $value['idSection'];
								$list_name_sections = $mysqli->query("SELECT `nameSection` FROM `sections` WHERE `idSection` = '$id_section'");
								$name_section = $list_name_sections->fetch_assoc();
								echo "<li><a href='#''>".$name_section['nameSection']."</a></li>";
							}

							$mysqli->close();
						?>
					</ul>
				</li>
			</ul>  
		</div>

		<div id="contact">
			Контакты
		</div>

		<div id="about">
			О нас
		</div>

		<div id="city">
			<? 
				echo $city_w['nameCity'];
			?>
		</div>

		<div id="profile">
			<details>
				<summary>
				<img src="img/icon.png">
				</summary>
				<div>
					<? if($post['namePost'] == 'Директор') { ?>
						<a class='btn-create'>
							Добавить нового сотрудника
						</a>
						<br>
						<? if($data['idPost'] == 1) { ?>
							<a class="btn-edit">
								Редактировать данные сотрудников
							</a>
						<? } ?>
						<br>
						<a class='btn-delete'>
							Удалить данные сотрудника
						</a>
						<br>
					<? } ?>
					<a href='logout.php'>
						Выход
					</a>
				</div>
			</details>
		</div>
	</div>

	<div id="body">
		<div id="level1">
			<div id="user__photo">
				<img src="img/incognito.png">
			</div>
			<div id="info">
				<table>
					<? 
						echo "<tr> <td><p> ФИО:         </p></td> <td><p>".$data['namePeople']."    </p></td> </tr>";
						echo "<tr> <td><p> Телефон:     </p></td> <td><p>".$data['phone']."         </p></td> </tr>";
						echo "<tr> <td><p> E-mail:      </p></td> <td><p>".$data['email']."         </p></td> </tr>";
						echo "<tr> <td><p> Адрес:       </p></td> <td><p>".$data['address']."</p></td> </tr>";
						echo "<tr> <td><p> Должность:   </p></td> <td><p>".$post['namePost']."      </p></td> </tr>";
						echo "<tr> <td><p> Магазин:     </p></td> <td><p>".$market['nameMarket']."  </p></td> </tr>";
						if($data['idPost'] != 1) {
							echo "<tr> <td><p> Отдел:       </p></td> <td><p>".$section['nameSection']."</p></td> </tr>";
						}
						echo "<tr> <td><p> Дата приема: </p></td> <td><p>".$data['dateEmployment']."</p></td> </tr>";
					?>
				</table>
			</div>
		</div>

		<div id="existence">
			<h2> 
				НАЛИЧИЕ 
			</h2>
			<table>
				<tr>
					<th> 
						Товар 
					</th>
					<th> 
						Количество 
					</th>
					<th> 
						Стоимость 
					</th>
				</tr>
				<? 
					$mysqli = new mysqli("localhost", "mysql", "mysql", "course");
					$mysqli->set_charset("utf8");

					$len = 0;

					while($row = $existence->fetch_assoc()) {
						echo "<tr>";

						// Получаем название продукта
						$idproduct = $row['idProduct'];
						$products = $mysqli->query("SELECT `nameproduct` FROM `products` where `idProduct` = '$idproduct'");
						$product = $products->fetch_assoc();

						echo "<td>".$product['nameproduct']."</td>".
							 "<td>".$row['amount']."</td>".
							 "<td>".$row['cost']."</td>";

						echo "</tr>";

						$len++;
					}

					$mysqli->close();
				?>
			</table>
		</div>

		<div id="deliveries">
			<h2> 
				ПОСТАВКИ 
			</h2>
			<div class="wrapper">
		        <div class="div-btn">
		            <div class="side default-side btn btn-warning">
		            	Заказать товар
		            </div>
		            <div class="side hover-side btn btn-warning">
		            	Отменить заказ
		            </div>
		        </div>
		        <button type="button" class="btn btn-success">
		        	Сделать заказ
		        </button>
		     </div>
			<table>
				<tr>
					<th> 
						Товар 
					</th>
					<th> 
						Поставщик 
					</th>
					<th> 
						Количество 
					</th>
					<th> 
						Стоимость поставки 
					</th>
				</tr>
			</table>
			<div class="group">
				<? 
					for ($i=1; $i <= $len; $i++) { 
						echo "<div class='but'>";
						echo "<input type='checkbox' class='cb' id='cb".$i."' />";
						echo "<label class='label' for='check".$i."'></label>";
						echo "</div>";
					}
				?>
			</div>
			<table>
				<? 
					$mysqli = new mysqli("localhost", "mysql", "mysql", "course");
					$mysqli->set_charset("utf8");

					$i = 1;

					while($row = $deliveries->fetch_assoc()){    // получаем все строки в цикле по одной
						echo "<tr class='tr".$i."'>";		

						// Получаем название продукта
						$idproduct = $row['idProduct'];
						$products = $mysqli->query("SELECT `nameproduct` FROM `products` where `idProduct` = '$idproduct'");
						$product = $products->fetch_assoc();

						// Наименование поставщика
						$idprovider = $row['idProvider'];
						$providers = $mysqli->query("SELECT * FROM `providers` where `idProvider` = '$idprovider'");
						$provider = $providers->fetch_assoc();

						// Город поставщика
						$num_city_provider = $provider['idCity'];
						$cities_p = $mysqli->query("SELECT `nameCity` FROM `cities` where `idCity` = '$num_city_provider'");
						$city_p = $cities_p->fetch_assoc();

						echo '<td id="cb-data-'.$i.'">'.$product['nameproduct'].'</td><td>'.$provider['nameProvider'].'
							<details>
								<summary><svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="128" cy="128" r="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></circle><circle cx="128" cy="180" r="12"></circle><path d="M127.9995,144.0045v-8a28,28,0,1,0-28-28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg></summary>
								<div>
									Наименование: '.$provider['nameProvider'].'<br>Город: '.$city_p['nameCity'].'<br> Адрес: '.$provider['address'].'<br> Телефон: '.$provider['phone'].'<br>
								</div>
							</details>
							</td><td>'.$row['amount'].'</td><td>'.$row['cost'].'</td>'; // выводим данные

						echo "</tr>";

						$i++;
					}

					$mysqli->close();
				?>
			</table>
		</div>
	</div>

	<div id="modal"></div>
	<div id="create">
		<div id="error"></div>
	</div>
	<div id="edit">
		
	</div>
	<div id="wait">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47 63.5" fill="#fff" class="sand-clock">
			<path d="M1.27,8.39H4.89A32.64,32.64,0,0,0,8.51,22.57C10.9,27,14.18,30.27,18,31.9a1.29,1.29,0,0,0,.51.1,1.26,1.26,0,0,0,1.16-.75A1.23,1.23,0,0,0,19,29.61C12.46,26.83,7.81,18.2,7.44,8.39H45.73A1.26,1.26,0,0,0,47,7.14V1.25A1.26,1.26,0,0,0,45.73,0H1.27A1.26,1.26,0,0,0,0,1.25V7.14A1.26,1.26,0,0,0,1.27,8.39Zm1.28-5.9h41.9V5.9H2.55Z"/>
			
			<path d="M45.73,54.83H42.11a34.43,34.43,0,0,0-3.62-14.64,21.68,21.68,0,0,0-7.31-8.46A20.9,20.9,0,0,0,37.53,25a32.65,32.65,0,0,0,4.33-13,1.27,1.27,0,1,0-2.53-.31C38.26,20.57,33.8,28,28,30.55a1.29,1.29,0,0,0-.77,1.18A1.27,1.27,0,0,0,28,32.91C34.54,35.79,39.2,44.7,39.56,54.83H7.44c.27-7.58,2.91-14.55,7.18-18.83a1.28,1.28,0,0,0,0-1.81,1.26,1.26,0,0,0-1.8,0C8.09,38.92,5.17,46.57,4.89,54.83H1.27A1.28,1.28,0,0,0,0,56.12v6.09A1.28,1.28,0,0,0,1.27,63.5H45.73A1.28,1.28,0,0,0,47,62.21V56.12A1.28,1.28,0,0,0,45.73,54.83Zm-1.28,6.1H2.55V57.41h41.9Z"/>
			
			<path class="sand-top" d="M34.94,12.82a1.28,1.28,0,0,0-1-.5H12.51a1.27,1.27,0,0,0-1,.5,1.29,1.29,0,0,0-.24,1.12,24.16,24.16,0,0,0,4.34,9.22c2.2,2.72,4.84,4.16,7.62,4.16s5.42-1.44,7.63-4.16a24.15,24.15,0,0,0,4.33-9.22A1.32,1.32,0,0,0,34.94,12.82ZM23.21,24.72c-4.1,0-7.34-4.7-9-9.8h18C30.55,20,27.31,24.72,23.21,24.72Z"/>
			
			<path class="sand-bottom" d="M34.94,49.82a1.31,1.31,0,0,1-1,.5H12.51a1.31,1.31,0,0,1-1.26-1.62,24.16,24.16,0,0,1,4.34-9.22c2.2-2.72,4.84-4.16,7.62-4.16s5.42,1.44,7.63,4.16a24.15,24.15,0,0,1,4.33,9.22A1.32,1.32,0,0,1,34.94,49.82ZM23.21,37.92c-4.1,0-7.34,4.7-9,9.8h18C30.55,42.62,27.31,37.92,23.21,37.92Z"/>
		</svg>
		<p class="wait__text">
			Ожидается ответ от сервера...
		</p>
	</div>

	<!-- Закрытие окон по нажатию вне блока -->
	<script type="text/javascript">
		$(document).on('click', function(e) {
		  	if (!$(e.target).closest('details').length) {
		    	$('details').removeAttr('open');
		  	}
		  	e.stopPropagation();
		});
	</script>

	<!-- Появление checkbox для выбора товаров -->
	<script type="text/javascript">
		$('.div-btn').on('click', function(e) {
			var width = $('#deliveries > table:last-child').width();

			if($('.group').css('width') == '0px') {
				$('#deliveries > table:last-child').css('width', width - 50);
				$('.group').css('width', '50px');
		  		$('.div-btn').addClass('hover');
				setTimeout(() => {
					$('.btn-success').css('left', '20px');
				}, 270);
			}
			else {
				$('.btn-success').css('left', '-180px');
				setTimeout(() => {
					$('#deliveries > table:last-child').css('width', width + 50);
					$('.div-btn').removeClass('hover');
					$('.group').css('width', '0px');
					$("input[type=checkbox]:checkbox").prop('checked', false);
					$('.sum').text('0');
				}, 290)
			}
		});

		var len = <? echo $len ?>;
		$('.group').css('height', 40*len);
	</script>

	<!-- Оформление заказа -->
	<script type="text/javascript">
		$('.btn-success').on('click', function(e) {
			// Получаем нажатые checkbox
			var input = $('input[type=checkbox]');

			// Количество нажатых checkbox
			var act = 0;

			for(var i = 1; i <= input.length; i++) {
				if (($('input[id="cb' + i + '"]').is(':checked')) && ($('.pr' + i).length == 0)){
			        var textOrder = $('td[id="cb-data-' + i + '"]').text();
			        var max = $('tr[class="tr' + i + '"] > td:nth-child(3)').html();

			        // Наименование товара
			        $('<div/>', {class: 'pr pr' + i}).appendTo('#modal');
			        $('<p/>', {text: textOrder}).appendTo('.pr' + i);

			        // Количество товара + кнопки
			        $('<button>', {class: 'btn-del', id:'max' + i}).appendTo('.pr' + i);
			        $('<textarea/>', {class: 'sum', id:'sum' + i, text: 0}).appendTo('.pr' + i);
			        $('<button>', {class: 'btn-del', id:'min' + i}).appendTo('.pr' + i);
			        $('<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>').appendTo('#max' + i);
			        $('<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-dash-square" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg>').appendTo('#min' + i);

			        // Блок вывода максимального количества товара
			        $('<div/>', {class: 'max max' + i, text: 'max: ' + max}).appendTo("#modal");

			        act++;
				}
				else if ((!$('input[id="cb' + i + '"]').is(':checked')) && ($('.pr' + i).length != 0)) {
					$('.pr' + i).detach();
					$('.max' + i).detach();
				}
		    };

			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-success',
					cancelButton: 'btn btn-danger'
				},
				buttonsStyling: false
			})

			var textHTML = $('#modal').html();

			if($('input[class="cb"]:checked').length != 0) {
				swalWithBootstrapButtons.fire({
					title: 'Ваш заказ',
					icon: 'question',
					html: textHTML,
					showCancelButton: true,
					confirmButtonText: 'Подтвердить',
					cancelButtonText: 'Отменить',
					reverseButtons: true
				}).then((result) => {
			  		if (result.isConfirmed) {
			    		swalWithBootstrapButtons.fire({
							title: 'Ваш заказ подтвержден!',
							text: 'Ваш заказ будет доставлен в ближайшее время.',
							icon: 'success'
			    		}).then((result) => {})
			    		$('.pr').detach();
			    		$('.max').detach();
			    		$('input:checked').prop('checked', false);
			  		} else if (result.dismiss === Swal.DismissReason.cancel) {
			    		swalWithBootstrapButtons.fire({
							title: 'Заказ отменен!',
							text: '',
							icon: 'error',
							showCancelButton: true,
							showConfirmButton: false,
							cancelButtonText: 'Отменить',
							reverseButtons: true
			    		})
			  		}
				})
			} else {
				swalWithBootstrapButtons.fire({
					title: 'Ваш заказ',
					icon: 'warning',
					html: 'Вы ничего не выбрали &#129300;',
					confirmButtonText: 'Ок',
					reverseButtons: true
				})
			}
		});
	</script>

	<!-- Кнопки +/- -->
	<script type="text/javascript">
		$(document).on('click','.btn-del', function() {
			var funID = $(this).attr('id');
			var fun = funID.substring(0,3);
			var id = funID.substring(3); 
			var curNum = parseInt($('.sum[id="sum'+id+'"]').html());
			var max = $('tr[class="tr'+id+'"] > td:nth-child(3)').html();

			if(fun == "max") {
				if(curNum < max) {
					curNum++;
				}
			} else {
				if(curNum > 0) {
					curNum--;
				}
			}

			$('.sum[id="sum'+id+'"]').html(curNum);
		});	
	</script>

	<!-- Добавление данных нового сотрудника-->
	<script type="text/javascript">
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success submit',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})

		$('.btn-create').on('click', function() {

			function main_alert(icon) {
				var textCREATE = $('#create').html();
				textCREATE += '<? $html = file_get_contents('create.php'); $html = $html = preg_replace("/\s+/", " ", $html); echo $html; ?>';
				var textWAIT = $('#wait').html();

				swalWithBootstrapButtons.fire({
					title: 'Данные нового сотрудника',
					icon: icon,
					html: textCREATE,
					showCancelButton: true,
					confirmButtonText: 'Подтвердить',
					cancelButtonText: 'Отменить',
					background: '#15172b',
					color: '#fff',
					reverseButtons: true
				}).then((result) => {
			  		if (result.isConfirmed) {
			  			create();
			    		swalWithBootstrapButtons.fire({
							html: textWAIT,
							text: 'Ожидайте',
							background: '#15172b',
							color: '#fff',
							customClass: {
							  	htmlContainer: 'answer'
							},
							showConfirmButton: false,
			    		})
			  			setTimeout(() => {
				  			if ($('#error').html() == 'Записи успешно вставлены.') {
				  				Swal.close();
				  			}
				  			else {
				  				main_alert('error');
				  			}
			  			}, 2000);
			  		}
				})
				$("#date").mask("9999-99-99", {placeholder: "ГГГГ-ММ-ДД" });
				$("#phone").mask("+7(999) 999-99-99");
			}

			main_alert('question');

			$(".list").keyup(function(event) {
				var id = $(this).attr('id');
				search(id, event);
			});

			$('.result').on('click', function() {
	    		var result = $(this).text();
	    		var fieldsResult = $(this).attr('class');
	    		var idOfInput = fieldsResult.split(' '); 
	    		$('#' + idOfInput[1]).val(result);
			});

			/*(async () => {
				const { value: formValues } = await Swal.fire({
				  	title: 'Multiple inputs',
				  	html:
					    '<input id="swal-input1" class="swal2-input">' +
					    '<input id="swal-input2" class="swal2-input">',
				  	focusConfirm: false,
				  	preConfirm: () => {
				    	return [
				      		document.getElementById('swal-input1').value,
				      		document.getElementById('swal-input2').value
				    	]
				  	}
				})

				if (formValues) {
				  Swal.fire(JSON.stringify(formValues))
				}
			})()*/
		})
	</script>

	<!-- Редактирование данных -->
	<script type="text/javascript">
		$('.btn-edit').on('click', function() {
			var textEDIT = '<form><div class="input-container ic1"><input id="people" class="list input" type="text" name="people" placeholder=" " required /><div class="cut"></div><label for="people" class="placeholder__text ">Full name</label></div></form><div id="display-people"></div>';
			swalWithBootstrapButtons.fire({
				title: 'Данные нового сотрудника',
				icon: 'question',
				html: textEDIT,
				showCancelButton: true,
				confirmButtonText: 'Подтвердить',
				cancelButtonText: 'Отменить',
				background: '#15172b',
				color: '#fff',
				reverseButtons: true
			}).then((result) => {
		  		if (result.isConfirmed) {
		    		swalWithBootstrapButtons.fire({
						html: textWAIT,
						text: 'Ожидайте',
						background: '#15172b',
						color: '#fff',
						customClass: {
						  	htmlContainer: 'answer'
						},
						showConfirmButton: false,
		    		})
		  		}
			})

			/* Переделать через цикл php
			var count__people = <? //echo count($people); ?>;
			for (var i = 1; i <= count__people; i++) {
				$('#display').html('<div class="people people' + i + '"><? //echo ?></div>');
			}*/

			$(".list").keyup(function(event) {
				var id = $(this).attr('id');
				search(id, event);
			});

			$('.people').on('click', function() {
				
			})

			$('.result').сlick(function() {
	    		var result = $(this).text();
	    		var fieldsResult = $(this).attr('class');
	    		var idOfInput = fieldsResult.split(' '); 
	    		$('#' + idOfInput[1]).val(result);
			});
		})
	</script>

</body>
</html>