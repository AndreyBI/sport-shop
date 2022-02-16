<?php 
	session_start();
	$mysqli = new mysqli("localhost", "mysql", "mysql", "course");
	$mysqli->set_charset("utf8");
	$sections = $mysqli->query("SELECT `nameSection` FROM `sections`");
	$cities = $mysqli->query("SELECT `namecity` FROM `cities`");

	$form = 'true';
	if (isset($_SESSION["user_id"])) {
		$form = 'false';
		$result_set = $mysqli->query("SELECT * FROM `people` WHERE `idPeople`='$id'");
		$workers = $result_set->fetch_assoc();
		$isBuyer = $workers['idPost'];
	}

	/*if (isset($_POST['login'])) {
		$email = $_POST['email'];
	    $phone = $_POST['phone'];*/
	    $result_set = $mysqli->query("SELECT `idPeople`, `phone` FROM `people` WHERE `email` = '$email'");
	    $data = $result_set->fetch_assoc();
	    /*if (!$data) {
	        $error = '<p class="error-text">Неверные почта!</p>';
	    } else {
	        if ($phone == $data['phone']) {
	            $_SESSION['user_id'] = $data['idPeople'];
	            header('Location: profile.php');
	            exit();
	        } else {
	            $error ='<p class="error-text">Неверные почта и/или номер телефона!</p>';
	        }
	    }
	};*/
	$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Sport</title>
	<link rel='stylesheet' href='//fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" href="css/style.css">
	<link rel='icon' href='img/logo.png'>
	<link rel="stylesheet" type="text/css" href="css/cs-select.css" />
	<link rel="stylesheet" type="text/css" href="css/cs-skin-elastic.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>	
	<script type="text/javascript">
		jQuery(document).ready(function($){
			<?php echo 'var form = '.$form; ?>;
			if (form == false) {
				$('details > div > div').css('display', 'none');
				$('details > div > a').css('display', 'block');
			}
			else {
				$('details > div > div').css('display', 'block');
				$('details > div > a').css('display', 'none');
			}
		});
	</script>	

	<!-- Карта -->
	<script type="text/javascript">
		function map() {
			var city = $('.cs-placeholder').html().trim();
			switch (city) {
				case 'Выберите город':
					$('.skw-page-6 .skw-page__content > div').css('display', 'none');
					$('.choose_city').css('display', 'block');
					break;
				case 'Красноярск':
					$('.skw-page-6 .skw-page__content > div').css('display', 'none');
					$('.krsk').css('display', 'block');
					break;
				case 'Томск':
					$('.skw-page-6 .skw-page__content > div').css('display', 'none');
					$('.tomsk').css('display', 'block');
					break;
				case 'Калининград':
					$('.skw-page-6 .skw-page__content > div').css('display', 'none');
					$('.klng').css('display', 'block');
					break;
				case 'Санкт-Петербург':
					$('.skw-page-6 .skw-page__content > div').css('display', 'none');
					$('.spb').css('display', 'block');
					break;
				case 'Москва':
					$('.skw-page-6 .skw-page__content > div').css('display', 'none');
					$('.msk').css('display', 'block');
					break;
				default:
					$('.skw-page-6 .skw-page__content > div').css('display', 'none');
					$('.def').css('display', 'block');
					break;
			}
		}
	</script>

	<!-- Location -->
	<script src="https://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
	<script type="text/javascript">
        $(document).ready(function(){
            ymaps.ready(function(){
                /*var geolocation = ymaps.geolocation;
                alert('Ваша страна: '+geolocation.country);
                alert('Ваш город: '+geolocation.city);
                alert('Ваш регион: '+geolocation.region);*/

                var city = ymaps.geolocation.city;

                $('li[data-option=""]').each(function(){
                	var choose_city = $(this).html();
                	choose_city = choose_city.slice(6, -7);
				   	if (choose_city == city) {
				   		$(this).addClass('cs-selected');
				   		$('.cs-placeholder').html(city);
				   		map();
				   	}
				});
            });
        });
	</script>

</head>

<body>

	<!-- partial:index.partial.html -->
	<div id="roof">
		<div id="logo">
			<div class="logo_img">
	      		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.91 92.91" fill="currentColor">
	        		<path d="M51.6 92.51v-1.63c.01-5.24.03-10.48.02-15.72 0-2.5-.94-3.53-3.47-3.52-3.63.01-7.19-.44-10.64-1.56-10.43-3.37-15.76-10.83-17.06-21.46-.19-1.57-.28-3.17-.32-4.75-.05-2.2.86-3.27 3.04-3.63.6-.1 1.21-.08 1.82-.08l33.56-.01c1.86 0 2.47-.81 1.47-2.38-2.69-4.23-6.38-7.18-11.55-7.44-4.53-.22-9.08-.04-13.62-.04-3.03 0-3.8-.75-3.83-3.81-.03-3.42-.02-6.84-.02-10.25v-1.94c-7.96.63-19.36 16.97-20.46 28.2a36.48 36.48 0 0030.58 39.65v10.4a44.47 44.47 0 01-24.01-10.1C7.3 74.38 1.53 63.99.26 51.34-2.64 22.7 19.45 2.22 41.2.36v16.55c.01 2.6.56 3 3.21 3.22 3.02.25 6.07.53 9 1.24 10.29 2.5 17.18 10.4 18.45 20.9a49 49 0 01.32 5.72c0 1.88-1.06 2.91-2.94 3.06-.7.06-1.4.03-2.1.03-10.87 0-21.73.04-32.59-.05-2.1-.02-2.85 1.22-1.68 3.06 2.53 3.94 6.13 6.38 10.77 6.77 4.18.36 8.4.23 12.61.32.8.01 1.6-.03 2.4.05 2.34.25 3.43 1.4 3.45 3.76.04 3.98.01 7.96.02 11.94 0 .53.09 1.07.15 1.8a31.76 31.76 0 008.28-5.53c6.46-5.9 10.48-13.2 11.59-21.86 1.51-11.88-2.06-22.19-10.56-30.67-5.18-5.17-11.47-8.3-18.63-9.73-.42-.08-1.08-.48-1.1-.75-.07-3.26-.04-6.52-.04-9.8 20.01 1.8 39.98 18.95 41.05 43.93a46.21 46.21 0 01-41.25 48.2z"></path>
	      		</svg>
		    </div>
		    <p>
		    	Sport
		    </p>
		</div>

		<div id="main_page">
			Главная
		</div>

		<div id="catalog">
			<ul class="menu">
				<li>
					<a href=#>
						Каталог
					</a>
					<ul class="submenu">
						<li>
							Каталог
						</li>
						<?
							foreach($sections as $key => $value) {
								if ($value['nameSection'] != 'Магазин') {
									echo "<li><a href='#'>".$value['nameSection']."</a></li>";
								}
							} 
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
			<section>
				<select class="cs-select cs-skin-elastic">
					<option value="" disabled selected>
						Выберите город
					</option>
					<?
						foreach($cities as $key => $value) {
							echo "<option value=''>".$value['namecity']."</option>";
						} 
					?>
				</select>
			</section>
			</ul>  
		</div>

		<div id="profile">
			<details>
				<summary>
				<img src="img/icon.png">
				</summary>
				<div>
					<div class='login' name="signin-form">
			  			<div id="error">
				  			<?php  
								echo $error;
							?>
						</div>
				    	<p class='title'>
				    		Вход для сотрудников
				    	</p>
				    	<input type='text' placeholder='Логин' id='email' name='email' autocomplete="off" autofocus required/>
				    	<i class='fa fa-user'></i>
				    	<input type='password' placeholder='Пароль' id='phone' name='phone' required/>
				    	<i class='fa fa-key'></i>
				    	<a href='#' id='forget-password'>
				    		Забыли пароль?
				    	</a>
				    	<button id='submit' name='login'>
				      		<i class='spinner'></i>
				      		<span class='state'>
				      			Вход
				      		</span>
				    	</button>
			  		</div>
			  		<a href='profile.php'>
			  			Профиль
			  		</a>
			  		<?
			  			if ($isBuyer == 6) {
			  		?>
			  			<a href="profile-user.php">
			  				Корзина
			  			</a>
			  		<?
			  			}
			  		?>
			  		<a href='logout.php'>
			  			Выход
			  		</a>
				</div>
			</details>
		</div>
	</div>

	<div class="skw-pages">
		<div class="skw-page skw-page-1 active">
			<div class="skw-page__half skw-page__half--left">
				<div class="skw-page__skewed">
					<div class="skw-page__content"></div>
				</div>
			</div>
			<div class="skw-page__half skw-page__half--right">
				<div class="skw-page__skewed">
					<div class="skw-page__content">
						<h1 class="skw-page__heading"><a href="mtb.php">
							ВЕЛОСИПЕДЫ
						</a></h1>
						<p class="skw-page__description">
							All off-roads are your
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="skw-page skw-page-2">
			<div class="skw-page__half skw-page__half--left">
				<div class="skw-page__skewed">
					<div class="skw-page__content">
						<h1 class="skw-page__heading"><a href="snow.php">
							СНОУБОРДЫ И ГОРНЫЕ ЛЫЖИ
						</a></h1>
						<p class="skw-page__description">
							All mountains are your
						</p>
					</div>
				</div>
			</div>
			<div class="skw-page__half skw-page__half--right">
				<div class="skw-page__skewed">
					<div class="skw-page__content"></div>
				</div>
			</div>
		</div>

		<div class="skw-page skw-page-3">
			<div class="skw-page__half skw-page__half--left">
				<div class="skw-page__skewed">
					<div class="skw-page__content"></div>
				</div>
			</div>
			<div class="skw-page__half skw-page__half--right">
				<div class="skw-page__skewed">
					<div class="skw-page__content">
						<h1 class="skw-page__heading"><a href="run.php">
							БЕГ
						</a></h1>
						<p class="skw-page__description">
							All roads are your
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="skw-page skw-page-4">
			<div class="skw-page__half skw-page__half--left">
				<div class="skw-page__skewed">
					<div class="skw-page__content">
						<h1 class="skw-page__heading"><a href="swim.php">
							ПЛАВАНИЕ
						</a></h1>
						<p class="skw-page__description">
							
						</p>
					</div>
				</div>
			</div>
			<div class="skw-page__half skw-page__half--right">
				<div class="skw-page__skewed">
					<div class="skw-page__content"></div>
				</div>
			</div>
		</div>

		<div class="skw-page skw-page-5">
			<div class="skw-page__half skw-page__half--left">
				<div class="skw-page__skewed">
					<div class="skw-page__content"></div>
				</div>
			</div>
			<div class="skw-page__half skw-page__half--right">
				<div class="skw-page__skewed">
					<div class="skw-page__content">
						<h1 class="skw-page__heading">
							<a href="tennis.php">
								Теннис
							</a>
						</h1>
						<p class="skw-page__description">
							
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="skw-page skw-page-6">
			<div class="skw-page__half skw-page__half--left">
				<div class="skw-page__skewed">
					<div class="skw-page__content">
						<!-- Выбрать город -->
						<div class="choose_city" style="display: none; position:relative;overflow:hidden;">
							Выберете город
						</div>

						<!-- Красноярск -->
						<div class="krsk" style="display: none; position:relative;overflow:hidden;">
							<a class="market" href="https://yandex.ru/maps/org/sporttsekh/176961358206/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px; position:absolute; top:0px;">
								СпортЦех
							</a>
							<a href="https://yandex.ru/maps/62/krasnoyarsk/category/appliance_rental/184108219/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px; position:absolute; top:14px;">
								Пункт проката в Красноярске
							</a>
							<a href="https://yandex.ru/maps/62/krasnoyarsk/category/bicycle_repair/9653087989/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px; position:absolute; top:28px;">
								Ремонт велосипедов в Красноярске
							</a>
							<iframe src="https://yandex.ru/map-widget/v1/-/CCU5IWeelD" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
						</div>

						<!-- Томск -->
						<div class="tomsk" style="display: none; position:relative; overflow:hidden;">
							<a class="market" href="https://yandex.ru/maps/org/trial_sport/191167973239/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px; position:absolute; top:0px;">
								Триал-Спорт
							</a>
							<a href="https://yandex.ru/maps/67/tomsk/category/sporting_goods_store/184107345/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px;position:absolute; top:14px;">
								Спортивный магазин в Томске
							</a>
							<a href="https://yandex.ru/maps/67/tomsk/category/tourism_equipment/184107355/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px;position:absolute; top:28px;">
								Товары для отдыха и туризма в Томске
							</a>
							<iframe src="https://yandex.ru/map-widget/v1/?display-text=%D0%94%D0%B5%D0%BA%D0%B0%D1%82%D0%BB%D0%BE%D0%BD&ll=84.985990%2C56.472349&mode=search&oid=191167973239&ol=biz&sctx=ZAAAAAgBEAAaKAoSCRVUVP1KeTRAEa3E2QAuWktAEhIJYPph%2B%2F7a3D8R%2BrL53rQXwz8iBgABAgMEBSgKOABAh6ANSAFqAnJ1nQHNzEw9oAEAqAEAvQFbdEF66gEA8gEA%2BAEAggIQ0JTQtdC60LDRgtC70L7QvYoCAJICAA%3D%3D&sll=84.985990%2C56.472349&sspn=0.006305%2C0.001994&text=%D0%94%D0%B5%D0%BA%D0%B0%D1%82%D0%BB%D0%BE%D0%BD&z=17.84" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
						</div>

						<!-- Калининград -->
						<div class="klng" style="display: none; position:relative;overflow:hidden;">
							<a class="market" href="https://yandex.ru/maps/org/sportmaster/40713892581/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px; position:absolute;top:0px;">
								Спортмастер
							</a>
							<a href="https://yandex.ru/maps/22/kaliningrad/category/sporting_goods_store/184107345/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px;position:absolute; top:14px;">
								Спортивный магазин в Калининграде
							</a>
							<a href="https://yandex.ru/maps/22/kaliningrad/category/tourism_equipment/184107355/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px; position:absolute;top:28px;">
								Товары для отдыха и туризма в Калининграде
							</a>
							<iframe src="https://yandex.ru/map-widget/v1/-/CCU5I0Fm-A" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
						</div>

						<!-- Санкт-Петербург -->
						<div class="spb" style="display: none; position:relative;overflow:hidden;">
							<a class="market" href="https://yandex.ru/maps/org/decathlon/53307038467/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px;position:absolute; top:0px;">
								Decathlon
							</a>
							<a href="https://yandex.ru/maps/2/saint-petersburg/category/sporting_goods_store/184107345/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px;position:absolute; top:14px;">
								Спортивный магазин в Санкт‑Петербурге
							</a>
							<a href="https://yandex.ru/maps/2/saint-petersburg/category/shoe_store/184107941/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px; position:absolute; top:28px;">
								Магазин обуви в Санкт‑Петербурге
							</a>
							<iframe src="https://yandex.ru/map-widget/v1/-/CCU5I0BTLD" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
						</div>

						<!-- Москва -->
						<div class="msk" style="display: none; position:relative;overflow:hidden;">
							<a class="market" href="https://yandex.ru/maps/org/asiks/230675248561/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px;position:absolute; top:0px;">
								Асикс
							</a>
							<a href="https://yandex.ru/maps/213/moscow/category/sports_apparel/184107341/?utm_medium=mapframe&utm_source=maps" style="color:#eee; font-size:12px;position:absolute; top:14px;">
								Спортивная одежда и обувь в Москве
							</a>
							<iframe src="https://yandex.ru/map-widget/v1/-/CCU5I0Rb3D" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
						</div>

						<!-- Default -->
						<div class="choose_city" style="display: none; position:relative;overflow:hidden;">
							Ошибка в определении города
						</div>
					</div>
				</div>
			</div>
			<div class="skw-page__half skw-page__half--right">
				<div class="skw-page__skewed">
					<div class="skw-page__content">
						<!-- Выберите город -->
						<div class="choose_city">
							<h1 class="skw-page__heading">
					      		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.91 92.91" fill="currentColor">
					        		<path d="M51.6 92.51v-1.63c.01-5.24.03-10.48.02-15.72 0-2.5-.94-3.53-3.47-3.52-3.63.01-7.19-.44-10.64-1.56-10.43-3.37-15.76-10.83-17.06-21.46-.19-1.57-.28-3.17-.32-4.75-.05-2.2.86-3.27 3.04-3.63.6-.1 1.21-.08 1.82-.08l33.56-.01c1.86 0 2.47-.81 1.47-2.38-2.69-4.23-6.38-7.18-11.55-7.44-4.53-.22-9.08-.04-13.62-.04-3.03 0-3.8-.75-3.83-3.81-.03-3.42-.02-6.84-.02-10.25v-1.94c-7.96.63-19.36 16.97-20.46 28.2a36.48 36.48 0 0030.58 39.65v10.4a44.47 44.47 0 01-24.01-10.1C7.3 74.38 1.53 63.99.26 51.34-2.64 22.7 19.45 2.22 41.2.36v16.55c.01 2.6.56 3 3.21 3.22 3.02.25 6.07.53 9 1.24 10.29 2.5 17.18 10.4 18.45 20.9a49 49 0 01.32 5.72c0 1.88-1.06 2.91-2.94 3.06-.7.06-1.4.03-2.1.03-10.87 0-21.73.04-32.59-.05-2.1-.02-2.85 1.22-1.68 3.06 2.53 3.94 6.13 6.38 10.77 6.77 4.18.36 8.4.23 12.61.32.8.01 1.6-.03 2.4.05 2.34.25 3.43 1.4 3.45 3.76.04 3.98.01 7.96.02 11.94 0 .53.09 1.07.15 1.8a31.76 31.76 0 008.28-5.53c6.46-5.9 10.48-13.2 11.59-21.86 1.51-11.88-2.06-22.19-10.56-30.67-5.18-5.17-11.47-8.3-18.63-9.73-.42-.08-1.08-.48-1.1-.75-.07-3.26-.04-6.52-.04-9.8 20.01 1.8 39.98 18.95 41.05 43.93a46.21 46.21 0 01-41.25 48.2z"></path>
					      		</svg>
						    	Sport
							</h1>
							<div class="skw-page__description">
								К сожалению мы не смогли определить ваше местоположение и поэтому не можем показать магазины в вашем городе. 
							</div>
						</div>

						<!-- Красноярск -->
						<div class="krsk">
							<h1 class="skw-page__heading">
								СпортЦех
							</h1>
							<div class="skw-page__description">
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
	  									<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
	  									<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
									</svg>
	  								пр.Красноярский рабочий 53, «Спортцех» 
								</div>
								<div class="block">
	  								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
									  	<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
									</svg>
									<a href="tel:+7 (391) 294-50-29 ">
										+7 (391) 294-50-29 
									</a>
								</div>
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
									  	<path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
									</svg>
									<a href="mailto:sportceh24@yandex.ru">
										sportceh24@yandex.ru
									</a>
								</div>
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
										<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
										<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
									</svg>
									Пн-Вс: 11:00 - 20:00
								</div>
							</div>
						</div>

						<!-- Томск -->
						<div class="tomsk">
							<h1 class="skw-page__heading">
								Триал-Спорт
							</h1>
							<div class="skw-page__description">
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
	  									<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
	  									<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
									</svg>
	  								ул. Герцена, д. 61/1, ТЦ "Город", 1 этаж
								</div>
								<div class="block">
	  								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
									  	<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
									</svg>
									<a href="tel:+7 (3822) 250-210">
										+7 (3822) 250-210
									</a>
								</div>
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
									  	<path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
									</svg>
									<a href="mailto:Tomsk01sale@trial-sport.ru">
										Tomsk01sale@trial-sport.ru
									</a>
								</div>
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
										<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
										<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
									</svg>
									Пн-Вс: 10:00 - 20:00
								</div>
							</div>
						</div>

						<!-- Калининград -->
						<div class="klng">
							<h1 class="skw-page__heading">
								Спортмастер
							</h1>
							<div class="skw-page__description">
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
	  									<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
	  									<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
									</svg>							
									ТРЦ "Европа", ул. Театральная, д. 30, лит.А
								</div>
								<div class="block">
	  								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
									  	<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
									</svg>
									<a href="tel:+7 (812) 777-777-1">
										+7 (812) 777-777-1
									</a>
								</div>
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
									  	<path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
									</svg>
									<a class="footer__content__column__link" href="mailto:e-commerce@sportmaster.ru">
										e-commerce@sportmaster.ru
									</a>
								</div>
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
										<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
										<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
									</svg>
									Пн-Вс: 10:00 - 21:00
								</div>
							</div>
						</div>

						<!-- Санкт-Петербург -->
						<div class="spb">
							<h1 class="skw-page__heading">
								DECATHLON
							</h1>
							<div class="skw-page__description">
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
	  									<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
	  									<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
									</svg>
	  								ТРЦ "Жемчужина" ул. Адмирала Трибуца, д.3, с.1
								</div>
								<div class="block">
	  								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
									  	<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
									</svg>
									<a href="tel:+7 (969) 737-22-35">
										+7 (969) 737-22-35
									</a>
								</div>
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
										<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
										<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
									</svg>
									Пн-Вс: 10:00 - 22:00
								</div>
							</div>
						</div>

						<!-- Москва -->
						<div class="msk">
							<h1 class="skw-page__heading">
								Асикс
							</h1>
							<div class="skw-page__description">
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
	  									<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
	  									<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
									</svg>
	  								Олимпийский проспект, дом 14
								</div>
								<div class="block">
	  								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
									  	<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
									</svg>
									<a href="tel:+7 (495) 961-35-75">
										+7 (495) 961-35-75
									</a>
								</div>
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
									  	<path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
									</svg>
									<a href="mailto:info-ru@asics.com" target="_blank">
										info-ru@asics.com
									</a>
								</div>
								<div class="block">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
										<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
										<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
									</svg>
									Пн-Чт: 9:00 - 18:00 Пт: 9:00 - 17:00
								</div>
							</div>
						</div>

						<!-- Default -->
						<div class="def" style="display: none; position:relative;overflow:hidden;">
							<h1 class="skw-page__heading">
					      		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.91 92.91" fill="currentColor">
					        		<path d="M51.6 92.51v-1.63c.01-5.24.03-10.48.02-15.72 0-2.5-.94-3.53-3.47-3.52-3.63.01-7.19-.44-10.64-1.56-10.43-3.37-15.76-10.83-17.06-21.46-.19-1.57-.28-3.17-.32-4.75-.05-2.2.86-3.27 3.04-3.63.6-.1 1.21-.08 1.82-.08l33.56-.01c1.86 0 2.47-.81 1.47-2.38-2.69-4.23-6.38-7.18-11.55-7.44-4.53-.22-9.08-.04-13.62-.04-3.03 0-3.8-.75-3.83-3.81-.03-3.42-.02-6.84-.02-10.25v-1.94c-7.96.63-19.36 16.97-20.46 28.2a36.48 36.48 0 0030.58 39.65v10.4a44.47 44.47 0 01-24.01-10.1C7.3 74.38 1.53 63.99.26 51.34-2.64 22.7 19.45 2.22 41.2.36v16.55c.01 2.6.56 3 3.21 3.22 3.02.25 6.07.53 9 1.24 10.29 2.5 17.18 10.4 18.45 20.9a49 49 0 01.32 5.72c0 1.88-1.06 2.91-2.94 3.06-.7.06-1.4.03-2.1.03-10.87 0-21.73.04-32.59-.05-2.1-.02-2.85 1.22-1.68 3.06 2.53 3.94 6.13 6.38 10.77 6.77 4.18.36 8.4.23 12.61.32.8.01 1.6-.03 2.4.05 2.34.25 3.43 1.4 3.45 3.76.04 3.98.01 7.96.02 11.94 0 .53.09 1.07.15 1.8a31.76 31.76 0 008.28-5.53c6.46-5.9 10.48-13.2 11.59-21.86 1.51-11.88-2.06-22.19-10.56-30.67-5.18-5.17-11.47-8.3-18.63-9.73-.42-.08-1.08-.48-1.1-.75-.07-3.26-.04-6.52-.04-9.8 20.01 1.8 39.98 18.95 41.05 43.93a46.21 46.21 0 01-41.25 48.2z"></path>
					      		</svg>
						    	Sport
							</h1>
							<div class="skw-page__description">
								К сожалению мы не смогли определить ваше местоположение и поэтому не можем показать магазины в вашем городе. 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- partial -->

	<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="js/script.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>
	<script>
		(function() {
			[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
				new SelectFx(el);
			} );
		})();
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#submit').click(function(){
				// collecting data from the form
		        var email = $('#email').val();
		        var phone = $('#phone').val();
				// the information sent
				$.ajax({
					url: "login.php", // where we send it
					type: "post", // transmission method
					dataType: "json", // Type of data transfer
					data: { // what we send
		                "email":  email,
		                "phone": phone
					},
					// after receiving the server response
					success: function(data){
		                if (data.result == '<p class="error-text">Неверные почта и/или номер телефона!</p>') {
		                	$('#error').html(data.result); // output the server response
		                }
		                else { 
		                	$('details > div > div').css('display', 'none');
							$('details > div > a').css('display', 'block');
							<?php 
							    if(!isset($_SESSION["user_id"])) {
							    	$_SESSION["user_id"] = $data['idPeople'];
							    } ?>
							document.location.href = "http://course/profile.php";
		                }
					}
		        });
			})
	    });
	</script>

	<!-- Закрытие окон по нажатию вне блока -->
	<script type="text/javascript">
		$(document).on('click', function(e) {
		  	if (!$(e.target).closest('details').length) {
		    	$('details').removeAttr('open');
		  	}
		  	e.stopPropagation();
		});
	</script>

	<!-- Переключение города -->
	<script type="text/javascript">
		$('li[data-option=""]').on('click', map);
	</script>

</body>
</html>
