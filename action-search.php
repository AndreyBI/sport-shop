<?php

    // Подключение к базе данных
    $connectionDB = mysqli_connect(

        "localhost", // Название хоста

        "mysql", // Пользователь

        "mysql", // Пароль пользователя

        "course" // Название базы данных
    );

    // Проверка подключения
    if (mysqli_connect_errno()) {

        echo "Невозможно подключится к MySQL: " . MySQLi_connect_error();

    }

    // Получаем значение переменной "search"
    if (isset($_POST['search'])) {

        // Помещаем поисковой запрос в переменной
        $searchName = $_POST['search'];
        $table = $_POST['table'];

        $field = $table;
        if ($table == 'cities') {
            $field = 'city';
        }
        elseif($table != 'people') {
            $field = substr($table, 0, -1);
        }

        $id = 'id'.$field;
        $name = 'name'.$field;

        // Запрос для выбора из базы данных
        $Query = "SELECT $id, $name FROM $table WHERE $name LIKE '%$searchName%' LIMIT 5";

        //Производим поиск в базе данных
        $ExecQuery = mysqli_query($connectionDB, $Query);

        // Создаем список для отображения результатов
        //echo '<ul>';

        //Перебираем результаты из базы данных
        while ($Result = mysqli_fetch_array($ExecQuery)) {

        /* Создаем элементы списка. При клике на результат вызываем функцию обработчика fill() из файла "script.js". В параметре передаем найденное имя

        <li onclick='fill("<?//php echo $Result['namePeople']; ?>")'>
            <a>
                <?//php echo $Result['namePeople']; ?>
            </a>
        </li>*/

        echo '<div class="result '.$table.' '.$field.$Result[$id].'">';
        echo $Result[$name];
        echo '</div>';

        }
    }
?>
    <!-- </ul> -->