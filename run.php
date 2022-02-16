<?php 
	session_start();
	$mysqli = new mysqli("localhost", "mysql", "mysql", "course");
	$mysqli->set_charset("utf8");
	$products = $mysqli->query("SELECT `nameproduct` FROM `products`");
	$cities = $mysqli->query("SELECT `namecity` FROM `cities`");
	if (isset($_POST['login'])) {
		$email = $_POST['email'];
	    $phone = $_POST['phone'];
	    $result_set = $mysqli->query("SELECT `idPeople`, `phone` FROM `people` WHERE `email` = '$email'");
	    $data = $result_set->fetch_assoc();
	    if (!$data) {
	        $error = '<p class="error-text">Неверные почта!</p>';
	    } else {
	        if ($phone == $data['phone']) {
	            $_SESSION['user_id'] = $data['idPeople'];
	            $error = '<p class="error-text">pass</p>';
	            header('Location: profile.php');
	            exit();
	        } else {
	            $error ='<p class="error-text">Неверные почта и/или номер телефона!</p>';
	        }
	    }
	};
	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Runnung by Sport</title>
  	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="css/styleRun.css">
	<link rel='icon' href='img/logo.png'>
	<link rel="stylesheet" type="text/css" href="css/cs-select.css" />
	<link rel="stylesheet" type="text/css" href="css/cs-skin-elastic.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  	<link rel='stylesheet' href='//www.littlesnippets.net/css/codepen-result.css'>
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
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
							foreach($products as $key => $value) {
								echo "<li><a href='#''>".$value['nameproduct']."</a></li>";
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
					<form class='login' action='' method='post' name="signin-form">
			  			<div id="error">
				  			<?php  
								echo $error;
							?>
						</div>
				    	<p class='title'>
				    		Вход для сотрудников
				    	</p>
				    	<input type='text' placeholder='Логин' name='email' autocomplete="off" autofocus required/>
				    	<i class='fa fa-user'></i>
				    	<input type='password' placeholder='Пароль' name='phone' required/>
				    	<i class='fa fa-key'></i>
				    	<a href='#' id='forget-password'>
				    		Забыли пароль?
				    	</a>
				    	<button name='login'>
				      		<i class='spinner'></i>
				      		<span class='state'>
				      			Вход
				      		</span>
				    	</button>
			  		</form>
				</div>
			</details>
		</div>
	</div>

	<div id="body">
		<div class="container">
	        <div class="imgBx">
	            <img src="//github.com/anuzbvbmaniac/Responsive-Product-Card---CSS-ONLY/blob/master/assets/img/jordan_proto.png?raw=true" alt="Nike Jordan Proto-Lyte Image">
	        </div>
	        <div class="details">
	            <div class="content">
	                <h2>
	                	Jordan Proto-Lyte 
	                	<br>
	                    <span>
	                    	Беговая коллекция
	                    </span>
	                </h2>
	                <p>
	                    Благодаря мягкой пенопластовой подкладки и легкой ткани в верхней части, Jordan Proteolytic являются созданными для комфорта в течение всего дня. 
	                    <br>
	                    Большая воздухопроницаемость: Легкая ткань из натуральной или синтетической кожи, что обеспечивает дышащую поддержку. 
	                    <bt>
	                    Мягкий комфорт: Полноразмерная поролоновая подошва обеспечивает легкую плюшевую амортизацию. 
	                    <br>
	                    Надежное сцепление: Увеличенная подошва с рисунком в елочку обеспечивает сцепление на различных поверхностях.
	                </p>
	                <p class="product-colors">
	                	Доступные цвета:
	                    <span class="black active" data-color-primary="#000" data-color-sec="#212121" data-pic="//github.com/anuzbvbmaniac/Responsive-Product-Card---CSS-ONLY/blob/master/assets/img/jordan_proto.png?raw=true"></span>
	                    <span class="red" data-color-primary="#7E021C" data-color-sec="#bd072d" data-pic="//github.com/anuzbvbmaniac/Responsive-Product-Card---CSS-ONLY/blob/master/assets/img/jordan_proto_red_black.png?raw=true"></span>
	                    <span class="orange" data-color-primary="#CE5B39" data-color-sec="#F18557" data-pic="//github.com/anuzbvbmaniac/Responsive-Product-Card---CSS-ONLY/blob/master/assets/img/jordan_proto_orange_black.png?raw=true"></span>
	                </p>
	                <h3>
	                	₽ 12,800
	                </h3>
	                <button>
	                	Купить
	                </button>
	            </div>
	        </div>
	    </div>
		<div id="other">
			<img src="img/strela.png" height="30px">
		</div>
	</div>

	<div id="level2">
		<figure class="snip1418">
			<img src="img/cross1.jpg" alt="sample85"/>
			<div class="add-to-cart"> 
				<i class="ion-android-add"></i>
				<span>
					В корзину
				</span>
			</div>
			<figcaption>
				<h3>
					DYNABLAST 2
				</h3>
				<p>
					Технология амортизации FLYTEFOAM Blast™, Трикотажный верх, Вырезы в промежуточной подошве обеспечивают превосходную пружинистость.
				</p>
				<div class="price">
				  	<s>
				  		₽10,490
				  	</s>
				  	₽5,245
				</div>
			</figcaption>
			<a href="#"></a>
		</figure>

		<figure class="snip1418 hover">
			<img src="img/cross2.jpg" alt="sample96"/>
			<div class="add-to-cart"> 
				<i class="ion-android-add"></i>
				<span>
					В корзину
				</span>
			</div>
			<figcaption>
				<h3>
					MAGIC SPEED
				</h3>
				<p>
					Кроссовки MAGIC SPEED ™ - это легкая гоночная модель с увеличенной высотой промежуточной подошвы, дополненная углеродной пластиной и упругой пеной. В этой модели используется технология GUIDESOLE ™, которая помогает экономить энергию и бежать, затрачивая меньше усилий.  
				</p>
				<div class="price">
			  		<s>
			  			₽13,990
			  		</s>
			  		₽9,793
				</div>
			</figcaption>
			<a href="#"></a>
		</figure>

		<figure class="snip1418">
			<img src="img/cross3.jpg" alt="sample92"/>
			<div class="add-to-cart"> 
				<i class="ion-android-add"></i>
				<span>
					В корзину
				</span>
			</div>
			<figcaption>
				<h3>
					C-PROJECT (METASPEED SKY)
				</h3>
				<p>
					Материал проежуточной подошвы FLYTEFOAM™ PROPEL создан с добавлением эластомера, который обеспечивает высокий уровень возврата энергии. Запатентованная формула обеспечивает износостойкость, комфорт и легкость. Благодаря материалу FLYTEFOAM™ PROPEL облегчается отталкивание и улучшается отскок. 
				</p>
				<div class="price">
				  ₽20,990
				</div>
			</figcaption>
			<a href="#"></a>
		</figure>
	</div>

	<!-- partial -->
	<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script  src="js/script.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/react/16.13.0/umd/react.production.min.js'></script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/react-dom/16.13.0/umd/react-dom.production.min.js'></script>
	<script>
		(function() {
			[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
				new SelectFx(el);
			} );
		})();
	</script>
    <script>
        // Change The Picture and Associated Element Color when Color Options Are Clicked.
        $(".product-colors span").click(function() {
            $(".product-colors span").removeClass("active");
            $(this).addClass("active");
            $(".active").css("border-color", $(this).attr("data-color-sec"))
            $("body").css("background", $(this).attr("data-color-primary"));
            $(".content h2").css("color", $(this).attr("data-color-sec"));
            $(".content h3").css("color", $(this).attr("data-color-sec"));
            $(".container .imgBx").css("background", $(this).attr("data-color-sec"));
            $(".container .details button").css("background", $(this).attr("data-color-sec"));
            $(".imgBx img").attr('src', $(this).attr("data-pic"));
        });
    </script>
    <script type="text/javascript">
    	$(".hover").mouseleave(
			function () {
				$(this).removeClass("hover");
			}
		);
		$("figure").mouseenter(function () {
			$(this).css('height', '100%');
		}).mouseleave(function(){    
			$(this).css('height', '500px');        
		});
    </script>

</body>
</html>