<?php 
	session_start();
	$mysqli = new mysqli("localhost", "mysql", "mysql", "course");
	$mysqli->set_charset("utf8");
	$result_set = $mysqli->query("SELECT `nameproduct` FROM `products`");
	$data = $result_set->fetch_assoc();
	$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  	<meta charset="UTF-8">
  	<title>Mountain bikes</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="css/styleMTB.css">
	<link rel='icon' href='img/logo.png'>
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#body').css('height', $(window).height());
			$('#body').css('width', $(window).width()+300);
			$('.container').css('width', $(window).width());

			/* Открытие/закрытие меню */
			var open = false;
			$('.pushmenu').click(function () {
				if (open == false) {
					$('.pushmenu').addClass('open');
					$('#body').css('left', '0px');
					open = true;
					$('#body').css('width', $('#body').width()-300);
					$('.container').css('width', $('#body').width()-300);
				} else {
					$('#body').css('left', '-300px');
					open = false;
					$('#body').css('width', $('#body').width()+300);
					$('.container').css('width', $('#body').width()-300);
					$('.pushmenu').removeClass('open');
				}
			})
		})
	</script>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			setInterval(function () {
				if ($('.product').hasClass('product--active')){
					$('.container').mousewheel(function(e, delta) {
					    $(this).scrollLeft(this.scrollLeft);
					    e.preventDefault();
					});	
					$('.product--active').mousewheel(function(e, delta) {
					    $(this).scrollLeft(this.scrollLeft);
					    $(this).scrollTop(this.scrollTop + (-delta * 250));
					    e.preventDefault();
					});	
				} else {
					$('.container').mousewheel(function(e, delta) {
					    $(this).scrollLeft(this.scrollLeft + (-delta * 250));
					    e.preventDefault();
					});	
				}

				/*if ($('details').attr('open') != undefined) {
					$('.container').mousewheel(function(e, delta) {
					    $(this).scrollLeft(this.scrollLeft);
					    e.preventDefault();
					});
					$('#product_box').mousewheel(function(e, delta) {
					    $(this).scrollTop(this.scrollTop + (-delta * 250));
					    e.preventDefault();
					});
				}*/
			},10);
		});
	</script>
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', () => {
			document.querySelector('.sub-menu li:first-child').classList.toggle('current-menu-item');

			// получаем все элементы с классом pushmenu
			const pushmenu = document.getElementsByClassName('pushmenu');

			// Получим все родительские элементы в меню
			const sidebarAccordeon = document.querySelectorAll('.sidebar .menu-parent-item a:first-child');
			const accordeonFunction =  function() { 
				this.parentNode.querySelector('ul').classList.toggle('show');
				this.querySelector('i').classList.toggle('rotate');
				if (this.parentNode.querySelector('ul').classList.contains('show')) {
					document.querySelector('.sidebar').style.top = "20px";
					document.querySelector('.sidebar ul li').style.lineHeight = "40px";
				} else {
					document.querySelector('.sidebar').style.top = "26%";
					document.querySelector('.sidebar ul li').style.lineHeight = "60px";
				}
			}
			// Отслеживаем клики родительских пунктов меню 
			for( i=0; i < sidebarAccordeon.length; i++ ){
				sidebarAccordeon[i].addEventListener('click', accordeonFunction, false);
			}
		});
	</script>
</head>

<body>
	
<!-- partial:index.partial.html -->
<div id="body">
	<div id="menu">
		<div class="logo">
      		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.91 92.91" fill="currentColor">
        		<path d="M51.6 92.51v-1.63c.01-5.24.03-10.48.02-15.72 0-2.5-.94-3.53-3.47-3.52-3.63.01-7.19-.44-10.64-1.56-10.43-3.37-15.76-10.83-17.06-21.46-.19-1.57-.28-3.17-.32-4.75-.05-2.2.86-3.27 3.04-3.63.6-.1 1.21-.08 1.82-.08l33.56-.01c1.86 0 2.47-.81 1.47-2.38-2.69-4.23-6.38-7.18-11.55-7.44-4.53-.22-9.08-.04-13.62-.04-3.03 0-3.8-.75-3.83-3.81-.03-3.42-.02-6.84-.02-10.25v-1.94c-7.96.63-19.36 16.97-20.46 28.2a36.48 36.48 0 0030.58 39.65v10.4a44.47 44.47 0 01-24.01-10.1C7.3 74.38 1.53 63.99.26 51.34-2.64 22.7 19.45 2.22 41.2.36v16.55c.01 2.6.56 3 3.21 3.22 3.02.25 6.07.53 9 1.24 10.29 2.5 17.18 10.4 18.45 20.9a49 49 0 01.32 5.72c0 1.88-1.06 2.91-2.94 3.06-.7.06-1.4.03-2.1.03-10.87 0-21.73.04-32.59-.05-2.1-.02-2.85 1.22-1.68 3.06 2.53 3.94 6.13 6.38 10.77 6.77 4.18.36 8.4.23 12.61.32.8.01 1.6-.03 2.4.05 2.34.25 3.43 1.4 3.45 3.76.04 3.98.01 7.96.02 11.94 0 .53.09 1.07.15 1.8a31.76 31.76 0 008.28-5.53c6.46-5.9 10.48-13.2 11.59-21.86 1.51-11.88-2.06-22.19-10.56-30.67-5.18-5.17-11.47-8.3-18.63-9.73-.42-.08-1.08-.48-1.1-.75-.07-3.26-.04-6.52-.04-9.8 20.01 1.8 39.98 18.95 41.05 43.93a46.21 46.21 0 01-41.25 48.2z"></path>
      		</svg>
	    </div>
	    <p>
	    	Sport
	    </p>
	    <nav class="sidebar">
			<div class="menu-main-menu-container">
				<ul id="menu-main-menu">
					<li>
						<a href="index.php" >
							Главная
						</a>
					</li>
					<li class="menu-parent-item">
						<a href="#">
							Каталог
							<i></i>
						</a>
						<ul class="sub-menu">
							<?php 
								foreach($result_set as $key => $value) {
									echo "<li><a href='#''>".$value['nameproduct']."</a></li>";
								} 
							?>
						</ul>
					</li>
					<li>
						<a href="#">
							Контакты
						</a>
					</li>
					<li>
						<a href="#">
							О нас
						</a>
					</li>
				</ul>	
			</div>
		</nav> 
	</div>
	<div class="container">	
		<div class="nav">
			<div id="nav-icon3" class="pushmenu">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>	  
	    	<div class="nav__text">
	    		Specialized - Mountain Bikes
	    	</div>
	    	<div class="nav__cart">
	    		<details>
					<summary>
			    		<span>
			    			0
			    		</span>
			      		<svg class="nav__shop" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24">
			        	<circle cx="9" cy="21" r="1"></circle>
			        	<circle cx="20" cy="21" r="1"></circle>
		        		<path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"></path>
			      		</svg>
		      		</summary>
					<div id="product_box">
						<h2>
							Корзина
						</h2>					
						<button id="product__order" type="button" class="btn btn-success">
							Купить
						</button>
						<p>
							Ваша корзина пуста!
						</p>
					</div>
				</details>
	    	</div>
	  	</div>

	  	<div class="cover">
	  		Mountain<br/>Bikes
	  	</div>
	  	<div class="product" data-index="0">
	    	<div class="product__close">
	    		Close
	    	</div>
	    	<div class="product__new">
	    		NEW
	    	</div>
	    	<img class="product__img" alt="S-Works Turbo Levo | Metallic White Silver / Chrome / Dream Silver" src="https://assets.specialized.com/i/specialized/95221-06_LEVO-SW-CARBON-METWHTSIL-CHRM-DRMSIL_HERO?cache=on,on&amp;wid=640&amp;hei=480&amp;fmt=auto">
		    <div class="product__brand">
		    	TURBO LEVO
		    </div>
		    <div class="product__title">
		    	S-Works Turbo Levo
		    </div>
		    <div class="product__price">
		    	₽1,319,990
		    </div>
		    <div class="product__buttons" style="--delay: 0.2s">
		      <div class="product__options">
		        <button class="product__option size">
		        	S
		        </button>
		        <button class="product__option product__option--active size">
		        	M
		        </button>
		        <button class="product__option size">
		        	L
		        </button>
		        <button class="product__option size">
		        	XL
		        </button>
		      </div>
		      <button type="button" class="product__option product__add btn btn-danger">
		      	Добавить в корзину
		      </button>
		    </div>
		    <div class="product__subtitle">
		    	Совершенно новый Turbo Levo представляет собой невообразимое сочетание человека и машины. Обуздай технологии и преврати каждую поездку в незабываемое приключение. Больше скорости. Больше расстояния. Больше свободы. Больше маршрутов, больше незабываемых впечатлений...
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.3s">
		    	Совершенно новый Turbo Levo представляет собой невообразимое сочетание человека и машины. Обуздай технологии и преврати каждую поездку в незабываемое приключение. Больше скорости. Больше расстояния. Больше свободы. Больше маршрутов, больше незабываемых впечатлений... С момента своего появления Turbo Levo установил стандарт, на который ориентируются многие другие производители электровелосипедов, и обновлённый Levo в этом смысле ничуть не отстаёт от своих предшественников.
		    </div>
		    <ul class="product__subtitle product__subtitle--expanded" style="--delay: 0.4s">
		    	<li>
		    		Обновлённый Levo оснащён двигателем Turbo Full Power 2.2, батареей ёмкостью 700 Втч, а также блоком управления MasterMind Turbo Control Unit (TCU). В итоге вы получаете 90 Nm крутящего момента и внушительные 565 ватт мощности, которые могут быть доступны на протяжении 5 часов. Turbo Levo позволит вам кататься дальше и быстрее, чем когда-либо.ень.
		    	</li>
		    	<li>
		    		MasterMind TCU это мозг велосипеда. Он отображает всю необходимую информацию о вашей поездке, позволяет в режиме реального времени настраивать уровни поддержки, обновлять данные по беспроводному соединению, чтобы ваш велосипед со временем становился лучше. Функция MicroTune позволяет регулировать уровень помощи "на лету" с шагом в 10%.
		    	</li>
		    	<li>
		    		Новый Levo проектировался как Mullet. Меньшее 27,5-дюймовое колесо сзади позволило укоротить перья, что делает байк более игривым и манёвренным, в то время как 29-дюймовое переднее колесо эффективно справляется с любыми препятствиями на своём пути. Кокпит байка спроектирован таким образом, чтобы добиться наиболее центрального положения райдера, что положительно сказывается на зацепе и контроле байка на поворотах. Заваленный угол рулевого стакана в сочетании с уменьшенным офсетом вилки гарантируют контроль на сложном рельефе.
		    	</li>
		    	<li>
		    		Turbo Levo доступен в 6 различных вариантах геометрии. Угол рулевого стакана можно изменить с 63 до 65.5 градусов, а высоту каретки можно уменьшить или увеличить в пределах 7 мм. Это позволяет сделать байк более стабильным или юрким, в зависимости от ваших запросов.
		    	</li>
		    	<li>
		    		150 мм хода сзади имеют кастомный тюн и готовы к любым испытаниям. Подвеска великолепно отрабатывает мелкие неровности, отлично справляется с массивными, прямоугольными препятствиями, готова к любым перегрузкам при резкой смене рельефа, а также обеспечивает впечатляющую эффективность при педалировании.
		    	</li>
		    	<li>
		    		Размерная сетка S-sizing была разработана исходя из характеристик байка, а не роста райдера. 'S-sizing' подразумевает шесть опций, каждая из которых имеет идентичный стендовер и длину рулевого стакана, но разные рич и колёсную базу, чтобы каждый райдер мог подобрать байк, отталкиваясь от своего стиля езды или типа трейлов. Чем меньше S-размер, тем более манёвренным и отзывчивым будет байк. И наоборот — чем больше размер, тем больше стабильности и уверенности вы сможете получить.
		    	</li>
		    </ul>
		    <img class="product__detail-img" alt="S-Works Turbo Levo | Metallic White Silver / Chrome / Dream Silver" src="https://assets.specialized.com/i/specialized/95221-06_LEVO-SW-CARBON-METWHTSIL-CHRM-DRMSIL_FDSQ?auto=format&amp;fit=crop&amp;w=1900&amp;q=80">
		    <div class="product__table">
		      	<div class="product__table-title">
		      		ТЕХНИЧЕСКАЯ СПЕЦИФИКАЦИЯ
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		КОКПИТ
		        	</div>
		        	<div class="product__table-cell">
		        		<div class="specific">
		        			<p class="head__specific">
		        				ВЫНОС
		        			</p>
		        			<p class="text__specific">
		        				Deity, 35.0mm
		        			</p>
		        		</div>
		        		<div class="specific">
		        			<p class="head__specific">
		        				РУЛЬ
		        			</p>
		        			<p class="text__specific">
		        				Roval Traverse SL Carbon, riser bar, 6-degree upsweep, 8-degree backsweep, 30mm rise, 780mm, 35.0mm
		        			</p>
		        		</div>
		        		<div class="specific">
		        			<p class="head__specific">
		        				ОБМОТКА
		        			</p>
		        			<p class="text__specific">
		        				Deity, Knuckleduster, Black
		        			</p>
		        		</div>
		        		<div class="specific">
		        			<p class="head__specific">
		        				СЕДЛО
		        			</p>
		        			<p class="text__specific">
		        				Bridge, 155/143mm, Hollow Ti-rails
		        			</p>
		        		</div>
		        		<div class="specific">
		        			<p class="head__specific">
		        				ПОДСЕДЕЛЬНЫЙ ШТЫРЬ
		        			</p>
		        			<p class="text__specific">
		        				RockShox Reverb AXS, 30.9, 1X remote, (S1:100mm, S2: 125mm, S3: 150mm, S4-S6: 170mm)
		        			</p>
		        		</div>
		        	</div>
			    </div>
			    <div class="product__table-row">
		        	<div class="product__table-cell">
		        		ТОРМОЗА
		        	</div>
		       		<div class="product__table-cell">
	       				<div class="specific">
	       					<p class="head__specific">
	       						Передний тормоз
	       					</p>
	       					<p class="text__specific">
	       						Magura MT7, 4-piston caliper, hydraulic disc, 203mm rotor
	       					</p>
	       				</div>
	       				<div class="specific">
	       					<p class="head__specific">
	       						Задний тормоз
	       					</p>
	       					<p class="text__specific">
	       						Magura MT7, 4-piston caliper, hydraulic disc, 203mm rotor
	       					</p>
	       				</div>
		       		</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		Трансмиссия
		        	</div>
		        	<div class="product__table-cell">
	        			<div class="specific">
	        				<p class="head__specific">
	        					Задний переключатель
	        				</p>
	        				<p class="text__specific">
	        					SRAM XX1 Eagle AXS
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Кассета
	        				</p>
	        				<p class="text__specific">
	        					Sram XG-1299, 12-Speed, 10-52t
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Манетки
	        				</p>
	        				<p class="text__specific">
	        					SRAM Eagle AXS Rocker Paddle
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Цепь
	        				</p>
	        				<p class="text__specific">
	        					SRAM XX1 Eagle, 12-speed
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Каретка
	        				</p>
	        				<p class="text__specific">
	        					Praxis Carbon M30, custom offset, 160mm
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Система
	        				</p>
	        				<p class="text__specific">
	        					SRAM X-Sync Eagle, 104 BCD, 34T, steel
	        				</p>
	        			</div>
		         	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		Колеса
		        	</div>
		        	<div class="product__table-cell">
	        			<div class="specific">
	        				<p class="head__specific">
	        					Камеры
	        				</p>
	        				<p class="text__specific">
	        					Standard, Presta Valve
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Передний обод
	        				</p>
	        				<p class="text__specific">
	        					Traverse SL 29
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Задний обод
	        				</p>
	        				<p class="text__specific">
	        					Traverse SL 27.5
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Передняя покрышка
	        				</p>
	        				<p class="text__specific">
	        					Butcher, GRID TRAIL casing, GRIPTON® T9 compound, 2Bliss Ready, 29x2.6"
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Задняя покрышка
	        				</p>
	        				<p class="text__specific">
	        					Eliminator, GRID TRAIL casing, GRIPTON® T7 compound, 2Bliss Ready, 27.5x2.6"
	        				</p>
	        			</div>
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		E-BIKE
		        	</div>
		        	<div class="product__table-cell">
	        			<div class="specific">
	        				<p class="head__specific">
	        					Мотор
	        				</p>
	        				<p class="text__specific">
	        					Specialized Turbo Full Power System 2.2 Motor
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Заряд
	        				</p>
	        				<p class="text__specific">
	        					Custom charger, 42V4A w/ Rosenberger plug
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					UI/Remote
	        				</p>
	        				<p class="text__specific">
	        					Specialized MasterMind TCU, percentage of remaining charge, 120 possible display configurations, MicroTune assist adjustment, over-the-air updates, ANT+/Bluetooth®, w/Handlebar remote
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Батарея
	        				</p>
	        				<p class="text__specific">
	        					Specialized M3-700, Integrated battery, 700Wh
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Wiring Harness
	        				</p>
	        				<p class="text__specific">
	        					Custom Specialized wiring harness
	        				</p>
	        			</div>
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		Фреймсет
		        	</div>
		        	<div class="product__table-cell">
	        			<div class="specific">
	        				<p class="head__specific">
	        					Рама
	        				</p>
	        				<p class="text__specific">
	        					FACT 11m full carbon, 29" front wheel, 27.5" rear wheel, full internal cable routing, 148mm spacing, fully sealed cartridge bearings, 150mm of travel, geo adjust head tube, geo adjust horst pivot
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Вилка
	        				</p>
	        				<p class="text__specific">
	        					FOX FLOAT 38 Factory 29, Grip2 damper, 44mm offset, HSC, LSC, HSR, LSR, 110x15mm, 1.5" tapered steerer, 160mm travel, Kashima
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Подсидельный зажим
	        				</p>
	        				<p class="text__specific">
	        					Alloy, 38.6mm
	        				</p>
	        			</div>
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		      	  	<div class="product__table-cell">
		      	  		Подвеска
		      	  	</div>
		        	<div class="product__table-cell">
	        			<div class="specific">
	        				<p class="head__specific">
	        					Задний амортизатор
	        				</p>
	        				<p class="text__specific">
	        					FOX FLOAT X2 Factory, LSC, LSR, 2-position lever, 55x210mm, Kashima
	        				</p>
	        			</div>
		        	</div>
		      	</div>		    
		    </div>
		    <div class="product__grid">
		    	<img src="//images.unsplash.com/photo-1596646912242-80d82d06c463?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1594649537448-8133756764c0?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=975&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1582147037191-10d00acdf2d8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1589100984317-79246528923c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=2089&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1571068299107-cd63d456bf5d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1567&amp;q=80"/>
		    </div>
		    <div class="product__detail">ПОДРОБНЕЕ</div>
		</div>

		<div class="product" data-index="1">
		    <div class="product__close">
		    	Close
		    </div>
		    <div class="product__new">
		    	NEW
		    </div>
		    <img class="product__img" alt="S-Works Epic - Speed of Light Collection | GLOSS SATIN RED TINT CHAMELEON/WHITE" data-component="styled-image" src="https://assets.specialized.com/i/specialized/90321-00_EPIC-SW-SPEED-OF-LIGHT-REDTNT-CMLN-WHT_HERO?cache=on,on&amp;wid=640&amp;hei=480">
		    <div class="product__brand">
		    	EPIC
		    </div>
		    <div class="product__title">
		    	S-Works Epic
		    </div>
		    <div class="product__price">
		    	₽1,319,990
		    </div>
		    <div class="product__buttons" style="--delay: 0.2s">
		      	<div class="product__options">
		        	<button class="product__option size">
		        		S
		        	</button>
		        	<button class="product__option product__option--active size">
		        		M
		        	</button>
		        	<button class="product__option size">	
		        		L
		        	</button>
		        	<button class="product__option size">
		        		XL
		        	</button>
		      	</div>
		      	<button class="product__option product__add btn">	
		      		Добавить в корзину
		      	</button>
		    </div>
		    <div class="product__subtitle">
		    	Тьма, Свет, Скорость—эти три ипостаси так переплетены, что не могут существовать друг без друга. Ничто во вселенной не движется быстрее света, но до и после остаётся лишь темнота. Коллекция Speed of Light вдохновлена этим взаимодействием и футуристическими ландшафтами, по которым катаются наши райдеры…
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.3s">
		    	Тьма, Свет, Скорость—эти три ипостаси так переплетены, что не могут существовать друг без друга. Ничто во вселенной не движется быстрее света, но до и после остаётся лишь темнота. Коллекция Speed of Light вдохновлена этим взаимодействием и футуристическими ландшафтами, по которым катаются наши райдеры. Все элементы, от байков и фреймсетов до джерси и обуви идеально сочетаются друг с другом, подобно тому, как переплетаются тьма, скорость и свет. Эй, парень! Да, ты, который выбирает самую легкую покрышку из 6 одинаковых, у нас есть кое-что для тебя. Некоторые могут назвать тебя одержимым, но не беспокойся, мы не в их числе. Мы с тобой на одной волне, ведь мы создали S-Works Epic. Бесчисленные часы проектирования, бесконечные тестовые круги, терабайты телеметрических данных — звучит неплохо, да? Ах да, и всё это во имя скорости.
		    </div>
		    <ul class="product__subtitle product__subtitle--expanded" style="--delay: 0.4s">
		    	<li>
		    		Если бы нас попросили описать скорость, то мы бы просто показали раму S-Works Epic. 100 мм хода в сочетании с BRAIN, карбоновый линк подвески, более жёсткий задний треугольник, кропотливая укладка слоёв без лишних наложений и наш фирменный FACT 12m карбон – идеальный рецепт скорости.
		    	</li>
		    	<li>
		    		Вилка RockShox SID SL ULTIMATE имеет 100 мм хода и контролируется встроенным BRAIN. Все регулировки демпфера выведены наверх для быстрой настройки на ходу.
		    	</li>
		    	<li>
		    		Абсолютно новый вилсет Roval Control SL имеет асимметричный профиль обода и внутреннюю ширину в 29 мм, что позволяет увеличить прочность, уменьшить вес и снизить вероятность проколов на 22 процента.
		    	</li>
		    	<li>
		    		Трансмиссия SRAM's XX1 Eagle AXS – это не только самый лёгкий и технологичный групсет на рынке. Он также рассчитан на максимально жёсткие нагрузки, которые испытывает трансмиссия на этапах Кубка Мира.
		    	</li>
		    </ul>
		    <img class="product__detail-img" alt="S-Works Epic - Speed of Light Collection | GLOSS SATIN RED TINT CHAMELEON/WHITE" data-component="styled-image" src="https://assets.specialized.com/i/specialized/90321-00_EPIC-SW-SPEED-OF-LIGHT-REDTNT-CMLN-WHT_FDSQ?auto=format&amp;fit=crop&amp;w=1900&amp;q=80">
		    <div class="product__table">
		      	<div class="product__table-title">
		      		ТЕХНИЧЕСКАЯ СПЕЦИФИКАЦИЯ
		      	</div>
		      	<div class="product__table-row">
		      		<div class="product__table-cell">
		        		КОКПИТ
		        	</div>
		        	<div class="product__table-cell">
		        		<div class="specific">
		        			<p class="head__specific">
		        				ВЫНОС
		        			</p>
		        			<p class="text__specific">
		        				S-Works SL, alloy, titanium bolts, 6-degree rise
		        			</p>
		        		</div>
		        		<div class="specific">
		        			<p class="head__specific">
		        				РУЛЬ
		        			</p>
		        			<p class="text__specific">
		        				S-Works Carbon XC Mini Rise, 6-degree upsweep, 8-degree backsweep, 10mm rise, 760mm, 31.8mm
		        			</p>
		        		</div>
		        		<div class="specific">
		        			<p class="head__specific">
		        				ОБМОТКА
		        			</p>
		        			<p class="text__specific">
		        				Specialized Trail Grips
		        			</p>
		        		</div>
		        		<div class="specific">
		        			<p class="head__specific">
		        				СЕДЛО
		        			</p>
		        			<p class="text__specific">
		        				Body Geometry S-Works Power, carbon fiber rails, carbon fiber base
		        			</p>
		        		</div>
		        		<div class="specific">
		        			<p class="head__specific">
		        				ПОДСЕДЕЛЬНЫЙ ШТЫРЬ
		        			</p>
		        			<p class="text__specific">
		        				S-Works FACT carbon, 10mm offset, 30.9mm
		        			</p>
		        		</div>
		        	</div>
			    </div>
			    <div class="product__table-row">
		        	<div class="product__table-cell">
		        		ТОРМОЗА
		        	</div>
		       		<div class="product__table-cell">
	       				<div class="specific">
	       					<p class="head__specific">
	       						Передний тормоз
	       					</p>
	       					<p class="text__specific">
	       						SRAM Level Ultimate, 2-piston caliper, hydraulic disc
	       					</p>
	       				</div>
	       				<div class="specific">
	       					<p class="head__specific">
	       						Задний тормоз
	       					</p>
	       					<p class="text__specific">
	       						SRAM Level Ultimate, 2-piston caliper, hydraulic disc
	       					</p>
	       				</div>
		       		</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		Трансмиссия
		        	</div>
		        	<div class="product__table-cell">
	        			<div class="specific">
	        				<p class="head__specific">
	        					Задний переключатель
	        				</p>
	        				<p class="text__specific">
	        					SRAM XX1 Eagle AXS, Ceramic Speed Pulley Wheels
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Кассета
	        				</p>
	        				<p class="text__specific">
	        					Sram XG-1299, 12-Speed, 10-52t
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Манетки
	        				</p>
	        				<p class="text__specific">
	        					SRAM Eagle AXS Rocker Paddle
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Цепь
	        				</p>
	        				<p class="text__specific">
	        					SRAM XX1 Eagle, 12-speed
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Каретка
	        				</p>
	        				<p class="text__specific">
	        					CeramicSpeed DUB, BSA 73 Threaded, Ceramic bearings
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Система
	        				</p>
	        				<p class="text__specific">
	        					Quarq XX1 Powermeter, DUB, 170/175mm, 34t
	        				</p>
	        			</div>
		         	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		Колеса
		        	</div>
		        	<div class="product__table-cell">
	        			<div class="specific">
	        				<p class="head__specific">
	        					Камеры
	        				</p>
	        				<p class="text__specific">
	        					Presta, 60mm valve
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Передняя тулка
	        				</p>
	        				<p class="text__specific">
	        					Roval Control SL, DT Swiss Internals, Ceramic Bearings, 6-bolt, 15mm thru-axle, 110mm spacing, Torque caps, 24h straight pull t-head
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Задняя втулка
	        				</p>
	        				<p class="text__specific">
	        					Roval Control SL, DT Swiss 180 Internals, DT Swiss Ratchet EXP, Ceramic bearings, 12mm thru-axle, 148mm spacing, 24h straight-pull
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Передняя покрышка
	        				</p>
	        				<p class="text__specific">
	        					Specialized Renegade, S-Works Casing, T5/T7 Compound, 29x2.35
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Задняя покрышка
	        				</p>
	        				<p class="text__specific">
	        					Specialized Renegade, S-Works Casing, T5/T7 Compound, 29x2.35
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Обода
	        				</p>
	        				<p class="text__specific">
	        					Roval Control SL, Carbon offset design, 29mm internal width, 4mm hook width, Tubeless ready, 24h
	        				</p>
	        			</div>
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		Фреймсет
		        	</div>
		        	<div class="product__table-cell">
	        			<div class="specific">
	        				<p class="head__specific">
	        					Рама
	        				</p>
	        				<p class="text__specific">
	        					S-Works FACT 12m Carbon, Progressive XC Race Geometry, Rider-First Engineered™, threaded BB, 12x148mm rear spacing, internal cable routing, 100mm of travel
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Swat
	        				</p>
	        				<p class="text__specific">
	        					SWAT EMT Cage-Mount Tool
	        				</p>
	        			</div>
	        			<div class="specific">
	        				<p class="head__specific">
	        					Подсидельный зажим
	        				</p>
	        				<p class="text__specific">
	        					Specialized Alloy 34.9, Titanium Bolt
	        				</p>
	        			</div>
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		      	  	<div class="product__table-cell">
		      	  		Подвеска
		      	  	</div>
		        	<div class="product__table-cell">
	        			<div class="specific">
	        				<p class="head__specific">
	        					Задний амортизатор
	        				</p>
	        				<p class="text__specific">
	        					RockShox-Specialized BRAIN, Rx XC Tune, 5 Position Platform Adjust, Rebound Adjust, Integrated Extension, 265x52.5mm
	        				</p>
	        				<div class="specific">
	        				<p class="head__specific">
	        					Вилка
	        				</p>
	        				<p class="text__specific">
	        					RockShox SID SL ULTIMATE BRAIN, Top-Adjust Brain damper, Debon Air, 15x110mm, 44mm offset, 100mm Travel
	        				</p>
	        			</div>
	        			</div>
		        	</div>
		      	</div>
		    </div>
		    <div class="product__grid">
		    	<img src="//images.unsplash.com/photo-1596646912242-80d82d06c463?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1594649537448-8133756764c0?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=975&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1582147037191-10d00acdf2d8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1589100984317-79246528923c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=2089&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1571068299107-cd63d456bf5d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1567&amp;q=80"/>
		    </div>
		    <div class="product__detail">
		    	ПОДРОБНЕЕ
		    </div>
		</div>

		<div class="product" data-index="2">
		    <div class="product__close">
		    	Close
		    </div>
		    <div class="product__new">
		    	NEW
		    </div>
		    <img class="product__img" alt="S-Works Epic Hardtail | SATIN CARBON / COLOR RUN BLUE MURANO PEARL / GLOSS CHROME FOIL LOGOS" data-component="styled-image" src="https://assets.specialized.com/i/specialized/91322-00_EPIC-HT-SW-CARB-BLUMRNO-CHRM_HERO?cache=on,on&amp;wid=640&amp;hei=480">
		    <div class="product__brand">
		    	EPIC
		    </div>
		    <div class="product__title">
		    	S-Works Epic Hardtail
		    </div>
		    <div class="product__price">
		    	₽1,011,990
		    </div>
		    <div class="product__buttons" style="--delay: 0.2s">
		      	<div class="product__options">
		        	<button class="product__option size">
		        		S
		        	</button>
		        	<button class="product__option product__option--active size">
		        		M
		        	</button>
			        <button class="product__option size">
			        	L
			        </button>
			        <button class="product__option size">
			        	XL
			        </button>
			    </div>
			    <button class="product__option product__add btn">
		      		Добавить в корзину
		      	</button>
		    </div>
		    <div class="product__subtitle">
		    	S-Works Epic Hardtail - это гоночный кросс-кантри байк, который может дать фору многим шоссейным велосипедам. При этом, имею самую легкую раму на рынке, этот байк обладает характеристиками настоящего кросс-кантри убийцы. История Epic Hardtail - это постоянная борьба за граммы и эффективность, порой, в ущерб комфорту и стабильности…
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.3s">
		    	S-Works Epic Hardtail - это гоночный кросс-кантри байк, который может дать фору многим шоссейным велосипедам. При этом, имею самую легкую раму на рынке, этот байк обладает характеристиками настоящего кросс-кантри убийцы.
			</div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.4s">
		    	История Epic Hardtail - это постоянная борьба за граммы и эффективность, порой, в ущерб комфорту и стабильности. Но в случае с новым поколением, мы решили, что для достижение успеха не обязательно постоянно бороться со своим байком и терпеть дискомфорт.
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.5s">
		    	Мы полностью переосмыслили каждый дюйм рамы, создав невероятно легкое, универсальное и комфортное шасси. Увеличенный клиренс покрышек, более агрессивная геометрия и больше вертикального флекса - вот наше определение скорости.
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.5s">
		    	Комплектация включает в себя: вилку RockShox SID SL ULTIMATE BRAIN со 100 мм хода, вилсет Roval Control SL, групсет SRAM Eagle XX1 AXS.
		    </div>
		    <ul class="product__subtitle product__subtitle--expanded" style="--delay: 0.4s">
		    	<li>
		    		Незаконно способная, невероятно лёгкая и впечатляюще комфортная - рама нового S-Works Epic Hardtail из FACT 12m карбона стала самой лёгкой в истории модели.
		    	</li>
		    	<li>
		    		Вилка RockShox SID SL ULTIMATE с технологией BRAIN.
		    	</li>
		    	<li>
		    		Беспроводная трансмиссия SRAM XX1 Eagle AXS.
		    	</li>
		    	<li>
		    		Новый вилсет Roval Control SL с внутренней шириной обода в 29 мм и весом всего 1240 грамм не только обладает феноменальной надёжностью и жёсткостью, но также гораздо эффективнее противостоит проколам.
		    	</li>
		    </ul>
		    <img class="product__detail-img" alt="S-Works Epic Hardtail | SATIN CARBON / COLOR RUN BLUE MURANO PEARL / GLOSS CHROME FOIL LOGOS" data-component="styled-image" src="https://assets.specialized.com/i/specialized/91322-00_EPIC-HT-SW-CARB-BLUMRNO-CHRM_FDSQ?auto=format&amp;fit=crop&amp;w=1900&amp;q=80">
		    <div class="product__table">
		      	<div class="product__table-title">
		      		TECHNICAL SPECIFICATIONS
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		FRAME
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus, quo id itaque veniam sapiente unde officia impedit maxime facere.
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		SEAT BINDER
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		REAR SHOCK
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus.
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		FORK
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus, quo id itaque veniam sapiente unde officia placeat non libero ducimus
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		STEM
		        	</div>
		        	<div class="product__table-cell">
		        		Quae optio a illo
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		HANDLEBARS
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus.
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		GRIPS
		        	</div>
		        	<div class="product__table-cell">
		        		Iste doloribus.
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		SADDLE
		        	</div>
		        	<div class="product__table-cell">
		        		Minima vero consequatur eos laudantium iste doloribus. Lorem ipsum dolor sit amet consectetur.
		        	</div>
		      	</div>
		    </div>
		    <div class="product__grid">
		    	<img src="//images.unsplash.com/photo-1596646912242-80d82d06c463?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1594649537448-8133756764c0?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=975&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1582147037191-10d00acdf2d8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1589100984317-79246528923c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=2089&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1571068299107-cd63d456bf5d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1567&amp;q=80"/>
		    </div>
		    <div class="product__detail">
		    	ПОДРОБНЕЕ
		    </div>
		</div>
		<div class="product" data-index="3">
		    <div class="product__close">
		    	Close
		    </div>
		    <div class="product__new">
		    	NEW
		    </div>
		    <img class="product__img" src="//trek.scene7.com/is/image/TrekBicycleProducts/TopFuel7SX_21_32984_B_Primary?$responsive-pjpg$&amp;cache=on,on&amp;wid=640&amp;hei=480"/>
		    <div class="product__brand">
		    	STUMPJUMPER
		    </div>
		    <div class="product__title">
		    	S-Worls Enduro Epic Hard
		    </div>
		    <div class="product__price">
		    	₽456,500
		    </div>
		    <div class="product__buttons" style="--delay: 0.2s">
		      	<div class="product__options">
			        <button class="product__option size">
			        	S
			        </button>
			        <button class="product__option product__option--active size">
			        	M
			        </button>
			        <button class="product__option size">
			        	L
			        </button>
			        <button class="product__option size">
			        	XL
			        </button>
		      	</div>
		      	<button class="product__option product__add btn">
		      		Добавить в корзину
		      	</button>
		    </div>
		    <div class="product__subtitle">
		    	Lorem ipsum dolor sit. Doloribus neque laborum fugiat officiis quae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur, in delectus tempore iusto dicta odio quas a placeat.
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.3s">
		    	Lorem ipsum dolor sit. Doloribus neque laborum fugiat officiis quae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur, in delectus tempore iusto dicta odio quas a placeat.
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.4s">
		    	Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, quos? Nesciunt quibusdam corporis quo repellendus sequi. Molestiae repellendus ab vitae mollitia distinctio quod molestias quis, suscipit magni id ex in?Nostrum quibusdam, sunt deleniti vel sapiente modi tempore ea omnis non adipisci earum totam illo esse quo voluptatem dignissimos excepturi saepe! Minima vero consequatur eos laudantium deleniti architecto ducimus quia?
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.5s">
		    	Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, quos? Nesciunt quibusdam corporis quo repellendus sequi. Molestiae repellendus ab vitae mollitia distinctio quod molestias quis, suscipit magni id ex in?Nostrum quibusdam, sunt deleniti vel sapiente modi tempore ea omnis non adipisci earum totam illo esse quo voluptatem dignissimos excepturi saepe! Minima vero consequatur eos laudantium deleniti architecto ducimus quia?
		    </div>
		    <img class="product__detail-img" src="//images.unsplash.com/photo-1555919965-a43982be9034?ixlib=rb-1.2.1&amp;ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;auto=format&amp;fit=crop&amp;w=1900&amp;q=80"/>
		    <div class="product__table">
		      	<div class="product__table-title">
		      		TECHNICAL SPECIFICATIONS
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		FRAME
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus, quo id itaque veniam sapiente unde officia impedit maxime facere.
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		SEAT BINDER
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		REAR SHOCK
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus.
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		FORK
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus, quo id itaque veniam sapiente unde officia placeat non libero ducimus
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		STEM
		        	</div>
		        	<div class="product__table-cell">
		        		Quae optio a illo
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		HANDLEBARS
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus.
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		GRIPS
		        	</div>
		        	<div class="product__table-cell">
		        		Iste doloribus.
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		SADDLE
		        	</div>
		        	<div class="product__table-cell">
		        		Minima vero consequatur eos laudantium iste doloribus. Lorem ipsum dolor sit amet consectetur.
		        	</div>
		      	</div>
		    </div>
		    <div class="product__grid">
		    	<img src="//images.unsplash.com/photo-1596646912242-80d82d06c463?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1594649537448-8133756764c0?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=975&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1582147037191-10d00acdf2d8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1589100984317-79246528923c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=2089&amp;q=80"/>
		    	<img src="//images.unsplash.com/photo-1571068299107-cd63d456bf5d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1567&amp;q=80"/>
		    </div>
		    <div class="product__detail">
		    	ПОДРОБНЕЕ
		    </div>
		</div>

		<div class="product" data-index="4">
		    <div class="product__close">
		    	Close
		    </div>
		    <div class="product__new">
		    	NEW
		    </div>
		    <img class="product__img" src="//trek.scene7.com/is/image/TrekBicycleProducts/XCaliber9_20_29760_B_Primary?$responsive-pjpg$&amp;cache=on,on&amp;wid=640&amp;hei=480"/>
		    <div class="product__brand">T
		    	URBO LEVO
		    </div>
		    <div class="product__title">
		    	Ticket DJ Frameset
		    </div>
		    <div class="product__price">
		    	₽129,700
		    </div>
		    <div class="product__buttons" style="--delay: 0.2s">
		      	<div class="product__options">
			        <button class="product__option size">
			        	S
			        </button>
			        <button class="product__option product__option--active size">
			        	M
			        </button>
			        <button class="product__option size">
			        	L
			        </button>
			        <button class="product__option size">
			        	XL
			        </button>
		      	</div>
		      	<button class="product__option product__add btn">
		      		Добавить в корзину
		      	</button>
		    </div>
		    <div class="product__subtitle">
		    	Lorem ipsum dolor sit. Doloribus neque laborum fugiat officiis quae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur, in delectus tempore iusto dicta odio quas a placeat earum, accusamus rem ut aut nobis, dolorem incidunt volu.
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.3s">
		    	Lorem ipsum dolor sit. Doloribus neque laborum fugiat officiis quae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur, in delectus tempore iusto dicta odio quas a placeat earum, accusamus rem ut aut nobis, dolorem incidunt volu.
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.4s">
		    	Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, quos? Nesciunt quibusdam corporis quo repellendus sequi. Molestiae repellendus ab vitae mollitia distinctio quod molestias quis, suscipit magni id ex in?Nostrum quibusdam, sunt deleniti vel sapiente modi tempore ea omnis non adipisci earum totam illo esse quo voluptatem dignissimos excepturi saepe! Minima vero consequatur eos laudantium deleniti architecto ducimus quia?
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.5s">
		    	Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, quos? Nesciunt quibusdam corporis quo repellendus sequi. Molestiae repellendus ab vitae mollitia distinctio quod molestias quis, suscipit magni id ex in?Nostrum quibusdam, sunt deleniti vel sapiente modi tempore ea omnis non adipisci earum totam illo esse quo voluptatem dignissimos excepturi saepe! Minima vero consequatur eos laudantium deleniti architecto ducimus quia?
		    </div>
		    <img class="product__detail-img" src="//images.unsplash.com/photo-1555919965-a43982be9034?ixlib=rb-1.2.1&amp;ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;auto=format&amp;fit=crop&amp;w=1900&amp;q=80"/>
		    <div class="product__table">
		      	<div class="product__table-title">
		      		TECHNICAL SPECIFICATIONS
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	FRAME
			        </div>
			        <div class="product__table-cell">
			        	Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus, quo id itaque veniam sapiente unde officia impedit maxime facere.
			        </div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	SEAT BINDER
			        </div>
			        <div class="product__table-cell">
			        	Lorem ipsum dolor
			        </div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	REAR SHOCK
			        </div>
			        <div class="product__table-cell">
			        	Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus.
			        </div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	FORK
			        </div>
			        <div class="product__table-cell">
			        	Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus, quo id itaque veniam sapiente unde officia placeat non libero ducimus
			        </div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		STEM
		        	</div>
		        	<div class="product__table-cell">
		        		Quae optio a illo
		        	</div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		HANDLEBARS
		        	</div>
		        	<div class="product__table-cell">
		        		Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus.
		        	</div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	GRIPS
			        </div>
			        <div class="product__table-cell">
			        	Iste doloribus.
			        </div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	SADDLE
			        </div>
			        <div class="product__table-cell">
			        	Minima vero consequatur eos laudantium iste doloribus. Lorem ipsum dolor sit amet consectetur.
			        </div>
		      	</div>			    
		    </div>
			<div class="product__grid">
	    		<img src="//images.unsplash.com/photo-1596646912242-80d82d06c463?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
	    		<img src="//images.unsplash.com/photo-1594649537448-8133756764c0?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=975&amp;q=80"/>
	    		<img src="//images.unsplash.com/photo-1582147037191-10d00acdf2d8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
	    		<img src="//images.unsplash.com/photo-1589100984317-79246528923c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=2089&amp;q=80"/>
	    		<img src="//images.unsplash.com/photo-1571068299107-cd63d456bf5d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1567&amp;q=80"/>
		    </div>
		    <div class="product__detail">
		    	ПОДРОБНЕЕ
		    </div>
		</div>

		<div class="product" data-index="5">
		    <div class="product__close">
		    	Close
		    </div>
		    <div class="product__new">
		    	NEW
		    </div><img class="product__img" src="//trek.scene7.com/is/image/TrekBicycleProducts/1008601_2017_A_1_820_Womens?$responsive-pjpg$&amp;cache=on,on&amp;wid=640&amp;hei=480"/>
		    <div class="product__brand">
		    	EPIC
		    </div>
		    <div class="product__title">
		    	Precaliber Suspension
		    </div>
		    <div class="product__price">
		    	₽154,900
		    </div>
		    <div class="product__buttons" style="--delay: 0.2s">
		      	<div class="product__options">
			        <button class="product__option size">
			        	S
			        </button>
			        <button class="product__option product__option--active size">
			        	M
			        </button>
			        <button class="product__option size">
			        	L
			        </button>
			        <button class="product__option size">
			        	XL
			        </button>
		      	</div>
		      	<button class="product__option product__add btn">
		      		Добавить в корзину
		      	</button>
		    </div>
		    <div class="product__subtitle">
		    	Lorem ipsum dolor sit. Doloribus neque laborum fugiat officiis quae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur, in delectus tempore iusto dicta odio quas a placeat earum, accusamus rem ut aut
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.3s">
		    	Lorem ipsum dolor sit. Doloribus neque laborum fugiat officiis quae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur, in delectus tempore iusto dicta odio quas a placeat earum, accusamus rem ut aut
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.4s">
		    	Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, quos? Nesciunt quibusdam corporis quo repellendus sequi. Molestiae repellendus ab vitae mollitia distinctio quod molestias quis, suscipit magni id ex in?Nostrum quibusdam, sunt deleniti vel sapiente modi tempore ea omnis non adipisci earum totam illo esse quo voluptatem dignissimos excepturi saepe! Minima vero consequatur eos laudantium deleniti architecto ducimus quia?
		    </div>
		    <div class="product__subtitle product__subtitle--expanded" style="--delay: 0.5s">
		    	Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, quos? Nesciunt quibusdam corporis quo repellendus sequi. Molestiae repellendus ab vitae mollitia distinctio quod molestias quis, suscipit magni id ex in?Nostrum quibusdam, sunt deleniti vel sapiente modi tempore ea omnis non adipisci earum totam illo esse quo voluptatem dignissimos excepturi saepe! Minima vero consequatur eos laudantium deleniti architecto ducimus quia?
		    </div>
		    <img class="product__detail-img" src="//images.unsplash.com/photo-1555919965-a43982be9034?ixlib=rb-1.2.1&amp;ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;auto=format&amp;fit=crop&amp;w=1900&amp;q=80"/>
		    <div class="product__table">
		      	<div class="product__table-title">
		      		TECHNICAL SPECIFICATIONS
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	FRAME
			        </div>
			        <div class="product__table-cell">
			        	Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus, quo id itaque veniam sapiente unde officia impedit maxime facere.
			        </div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	SEAT BINDER
			        </div>
			        <div class="product__table-cell">
			        	Lorem ipsum dolor
			        </div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	REAR SHOCK
			        </div>
			        <div class="product__table-cell">
			        	Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus.
			        </div>
				</div>
				<div class="product__table-row">
			        <div class="product__table-cell">
			        	FORK
			        </div>
			        <div class="product__table-cell">
			        	Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus, quo id itaque veniam sapiente unde officia placeat non libero ducimus
			        </div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	STEM
			        </div>
			        <div class="product__table-cell">
			        	Quae optio a illo
			        </div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	HANDLEBARS
			        </div>
			        <div class="product__table-cell">
			        	Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae optio a illo, earum, iste doloribus.
			        </div>
		      	</div>
		      	<div class="product__table-row">
			        <div class="product__table-cell">
			        	GRIPS
			        </div>
			        <div class="product__table-cell">
			        	Iste doloribus.
			        </div>
		      	</div>
		      	<div class="product__table-row">
		        	<div class="product__table-cell">
		        		SADDLE
		        	</div>
		        	<div class="product__table-cell">
		        		Minima vero consequatur eos laudantium iste doloribus. Lorem ipsum dolor sit amet consectetur.
		        	</div>
		      	</div>		    	
		    </div>
		    <div class="product__grid">
	    		<img src="//images.unsplash.com/photo-1596646912242-80d82d06c463?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
	    		<img src="//images.unsplash.com/photo-1594649537448-8133756764c0?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=975&amp;q=80"/>
	    		<img src="//images.unsplash.com/photo-1582147037191-10d00acdf2d8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80"/>
	    		<img src="//images.unsplash.com/photo-1589100984317-79246528923c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=2089&amp;q=80"/>
	    		<img src="//images.unsplash.com/photo-1571068299107-cd63d456bf5d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1567&amp;q=80"/>
		    </div>
		    <div class="product__detail">
		    	ПОДРОБНЕЕ
		    </div>
		</div>
		<div class="product__overlay"></div>
	</div>

	<div id="order__box">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47 63.5" class="sand-clock">
			<path d="M1.27,8.39H4.89A32.64,32.64,0,0,0,8.51,22.57C10.9,27,14.18,30.27,18,31.9a1.29,1.29,0,0,0,.51.1,1.26,1.26,0,0,0,1.16-.75A1.23,1.23,0,0,0,19,29.61C12.46,26.83,7.81,18.2,7.44,8.39H45.73A1.26,1.26,0,0,0,47,7.14V1.25A1.26,1.26,0,0,0,45.73,0H1.27A1.26,1.26,0,0,0,0,1.25V7.14A1.26,1.26,0,0,0,1.27,8.39Zm1.28-5.9h41.9V5.9H2.55Z"/>
			
			<path d="M45.73,54.83H42.11a34.43,34.43,0,0,0-3.62-14.64,21.68,21.68,0,0,0-7.31-8.46A20.9,20.9,0,0,0,37.53,25a32.65,32.65,0,0,0,4.33-13,1.27,1.27,0,1,0-2.53-.31C38.26,20.57,33.8,28,28,30.55a1.29,1.29,0,0,0-.77,1.18A1.27,1.27,0,0,0,28,32.91C34.54,35.79,39.2,44.7,39.56,54.83H7.44c.27-7.58,2.91-14.55,7.18-18.83a1.28,1.28,0,0,0,0-1.81,1.26,1.26,0,0,0-1.8,0C8.09,38.92,5.17,46.57,4.89,54.83H1.27A1.28,1.28,0,0,0,0,56.12v6.09A1.28,1.28,0,0,0,1.27,63.5H45.73A1.28,1.28,0,0,0,47,62.21V56.12A1.28,1.28,0,0,0,45.73,54.83Zm-1.28,6.1H2.55V57.41h41.9Z"/>
			
			<path class="sand-top" d="M34.94,12.82a1.28,1.28,0,0,0-1-.5H12.51a1.27,1.27,0,0,0-1,.5,1.29,1.29,0,0,0-.24,1.12,24.16,24.16,0,0,0,4.34,9.22c2.2,2.72,4.84,4.16,7.62,4.16s5.42-1.44,7.63-4.16a24.15,24.15,0,0,0,4.33-9.22A1.32,1.32,0,0,0,34.94,12.82ZM23.21,24.72c-4.1,0-7.34-4.7-9-9.8h18C30.55,20,27.31,24.72,23.21,24.72Z"/>
			
			<path class="sand-bottom" d="M34.94,49.82a1.31,1.31,0,0,1-1,.5H12.51a1.31,1.31,0,0,1-1.26-1.62,24.16,24.16,0,0,1,4.34-9.22c2.2-2.72,4.84-4.16,7.62-4.16s5.42,1.44,7.63,4.16a24.15,24.15,0,0,1,4.33,9.22A1.32,1.32,0,0,1,34.94,49.82ZM23.21,37.92c-4.1,0-7.34,4.7-9,9.8h18C30.55,42.62,27.31,37.92,23.21,37.92Z"/>
		</svg>
		<div class='fill'></div>
	</div>
<!-- partial -->

  	<script  src="js/scriptMTB.js"></script>
  	<script type="text/javascript">
  		$('.size').on('click', function() {
  			$('.size').removeClass('product__option--active');
  			$(this).addClass('product__option--active');
  		});

  		var id = 1;
  		var total__cost = '0';
  		$('.product__add').on('click', function() {
  			$('#product_box > p').detach();
  			var prID = $('.product--active').attr('data-index');
  			var prTEXT = $('.product--active > .product__title').html();
  			var prSIZE = $('.product--active .product__option--active').text();
  			$('<div class="pr pr' + id + '"><p style="color: white">' + prTEXT + '(' + prSIZE + ')</p></div').appendTo('#product_box');

  			// Кнопка удаления
	        $('<button class="remove__btn rb' + id + '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></button>').appendTo('.pr' + id);

  			// Количество товара + кнопки
	        $('<button>', {class: 'btn-del max-btn', id:'max' + id}).appendTo('.pr' + id);
	        $('<textarea/>', {class: 'sum', id:'sum' + id, text: 0}).appendTo('.pr' + id);
	        $('<button>', {class: 'btn-del min-btn', id:'min' + id}).appendTo('.pr' + id);
	        $('<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-plus-square" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>').appendTo('#max' + id);
	        $('<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-dash-square" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg>').appendTo('#min' + id);

	        // Стоимость товара
	        var cost = $('.product--active .product__price').html();
			cost = cost.replace(/\s{2,}/g, '');
	        $('<div/>', {class: 'cost cost' + id, text: 'Стоимость: ' + cost}).appendTo('.pr' + id);

	        // Увеличиваем число корзинки
	        var count__shop = $('summary > span').html();
	        count__shop++;
			$('summary > span').html(count__shop);	        

	  		// Общая стоимость
			cost = cost.substring(1);
			cost = cost.replace(/,/g, '');
			total__cost = total__cost.replace(/,/g, '');
			cost = parseInt(cost);
			total__cost = parseInt(total__cost);
			total__cost += cost;
			total__cost = total__cost.toString();
			var size = total__cost.length - 3;
			for (var i = size; i > 0 ; i -= 3) {
				total__cost = total__cost.substring(0, i) + ',' + total__cost.substring(i);
			}
	  		$('h2').html('Корзина на ₽' + total__cost);

	        id++;
  		});
  	</script>
  	<script type="text/javascript">
		$(document).on('click', '.btn-del', function(){
			var funID = $(this).attr('id');
			var fun = funID.substring(0,3);
			var id = funID.substring(3);
			var curNum = parseInt($('.sum[id="sum'+id+'"]').html());

			if(fun == "max") {
				if(curNum < 10) {
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
	<script type="text/javascript">
		$(document).on('mouseenter', '.pr', function() {
			var id = $(this).attr('class');
			id = id.substring(5);
            $('.rb' + id).css('display', 'flex');
        });
        $(document).on('mouseleave', '.pr', function() {
			var id = $(this).attr('class');
			id = id.substring(5);
            $('.rb' + id).css('display', 'none');
        });

        $(document).on('click', '.remove__btn', function(){
			var id = $(this).attr('class');
			id = id.substring(14);
			$('.pr' + id).css('overflow', 'hidden');
			$('.pr' + id).css('height', '0px');

			// Общая стоимость
			var current__cost = $('h2').html();
			current__cost = current__cost.substring(12);
			current__cost = current__cost.replace(/,/g, '');
			current__cost = parseInt(current__cost);
			var cost = $('.cost' + id).html();
			cost = cost.substring(12);
			cost = cost.replace(/,/g, '');
			cost = parseInt(cost);
			current__cost -= cost;
			current__cost = current__cost.toString();
			var size = current__cost.length - 3;
			for (var i = size; i > 0 ; i -= 3) {
				current__cost = current__cost.substring(0, i) + ',' + current__cost.substring(i);
			}
	  		$('h2').html('Корзина на ₽' + current__cost);

			setTimeout(() => {
				$('.pr' + id).detach();
			}, 4000);

			// Уменьшаем число корзинки
	        var count__shop = $('summary > span').html();
	        count__shop--;
			$('summary > span').html(count__shop);

			if(current__cost == '0') {
				$('<p/>', {text: 'Ваша корзина пуста!'}).appendTo('#product_box');
				$('h2').html('Корзина');
			}
        });
	</script>
	<script type="text/javascript">
		$(document).on('click', function(e) {
		  	if (!$(e.target).closest('details').length) {
		    	$('details').removeAttr('open');
		  	}
		  	e.stopPropagation();
		});
	</script>
	<script type="text/javascript">
		// Кнопка заказа

		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})
		
		var textORDER = $('#order__box').html();

		$('#product__order').on('click', function() {
			if(id == 1) {
				$('#product__order').disabled = true;
				Swal.fire(
					'Ваша корзина пуста!',
					'',
					'warning'
				)
			}
			else {
				swalWithBootstrapButtons.fire({
					html: textORDER,
					showCancelButton: true,
					confirmButtonText: 'Подтвердить',
					cancelButtonText: 'Отменить',
					reverseButtons: true
				}).then((result) => {

				})
			}
		})
	</script>
</body>
</html>
