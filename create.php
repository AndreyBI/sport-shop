<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div class="form">
		<div class="messages">
		</div>
      	<div class="input-container ic1">
        	<input id="name" class="input" type="text" name="name" placeholder=" " required />
        	<div class="cut"></div>
        	<label for="name" class="placeholder__text ">
        		Full name
        	</label>
      	</div>

      	<div class="input-container ic2">
        	<input id="phone" class="input" type="text" name="phone" placeholder=" " required />
        	<div class="cut"></div>
        	<label for="phone" class="placeholder__text ">
        		Phone
        	</label>
      	</div>

      	<div class="input-container ic2">
        	<input id="email" class="input" type="text" name="email" placeholder=" " required />
        	<div class="cut"></div>
        	<label for="email" class="placeholder__text ">
        		Email
        	</label>
      	</div>

      	<div class="input-container ic2">
        	<input id="photo" class="input" type="text" name="photo" placeholder=" " required />
        	<div class="cut"></div>
        	<label for="photo" class="placeholder__text ">
        		Photo
        	</label>
      	</div>

      	<div class="input-container ic2">
        	<input id="cities" class="list input" type="text" name="city" placeholder=" " list="cities" required />
        	<div class="cut"></div>
        		<!--<datalist id="cities">
				    <option name="1" value="Красноярск">
				    <option name="2" value="Томск">
				    <option name="3" value="Калининград">
				    <option name="4" value="Санкт-Петербург">
				    <option name="5" value="Москва">
				</datalist>-->
        	<label for="cities" class="placeholder__text ">
        		Город
        	</label>
        	<div id="display-cities"></div>
      	</div>

      	<div class="input-container ic2">
        	<input id="address" class="input" type="text" name="address" placeholder=" " required />
        	<div class="cut"></div>
        	<label for="address" class="placeholder__text ">
        		Адрес
        	</label>
      	</div>

      	<div class="input-container ic2">
	        <input list="posts" name="post" id="posts" class="list input" placeholder="" />
				<!--<datalist id="posts">
				    <option name="1" value="Директор">
				    <option name="2" value="Продавец">
				    <option name="3" value="Продавец-консультант">
				    <option name="4" value="Уборщик">
				    <option name="5" value="Амбассадор">
				</datalist>-->
        	<div class="cut"></div>
        	<label for="posts" class="placeholder__text ">
        		Должность
        	</label>
        	<div id="display-posts"></div>
      	</div>

      	<div class="input-container ic2">
        	<input id="markets" class="list input" type="text" name="market" placeholder=" " list="markets" required />
				<!--<datalist id="markets">
				    <option name="1" value="Спортцех">
				    <option name="2" value="Спортмастер">
				    <option name="3" value="Декатлон">
				    <option name="4" value="Триал спорт">
				    <option name="5" value="Асикс">
				</datalist>-->
        	<div class="cut"></div>
        	<label for="market" class="placeholder__text ">
        		Магазин
        	</label>
        	<div id="display-markets"></div>
      	</div>

      	<div class="input-container ic2">
        	<input id="sections" class="list input" type="text" nfmt="section" placeholder=" " list="sections" required />
        		<!--<datalist id="sections">
				    <option name="1" value="Магазин">
				    <option name="2" value="Велосипеды">
				    <option name="3" value="Сноуборды и горные лыжи">
				    <option name="4" value="Бег">
				    <option name="5" value="Плавание">
				    <option name="6" value="Теннис">
				</datalist>-->
        	<div class="cut"></div>
        	<label for="section" class="placeholder__text ">
        		Отедел
        	</label>
        	<div id="display-sections"></div>
      	</div>

      	<div class="input-container ic2">
        	<input id="date" class="input" type="text" name="date" placeholder="" required />
        	<div class="cut"></div>
        	<label for="date" class="placeholder__text ">
        		Дата устройства
        	</label>
      	</div>
    </div>

</body>
</html>