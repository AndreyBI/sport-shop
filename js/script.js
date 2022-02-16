$(document).ready(function() {

  var numOfPages = $(".skw-page").length;
  var animTime = 1000;
  var scrolling = false;
  var pgPrefix = ".skw-page-";

  for (var i = 1; i <= numOfPages; i++) {
    if(($('.skw-page-' + i).hasClass('active')) && (!$('.skw-page-' + i).hasClass('inactive'))) {
      var curPage = $('.skw-page-' + i).attr('class');
      curPage = curPage.substring(18,19);
      curPage = parseInt(curPage);
    }
  }

  function pagination() {
    scrolling = true;

    $(pgPrefix + curPage).removeClass("inactive").addClass("active");
    $(pgPrefix + (curPage - 1)).addClass("inactive");
    $(pgPrefix + (curPage + 1)).removeClass("active");

    setTimeout(function() {
      scrolling = false;
    }, animTime);
  };

  function navigateUp() {
    if (curPage === 1) return;
    curPage--;
    pagination();
  };

  function navigateDown() {
    if (curPage === numOfPages) return;
    curPage++;
    pagination();
  };

  $(document).on("mousewheel DOMMouseScroll", function(e) {
    if (scrolling) return;
    if (e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
      navigateUp();
    } else { 
      navigateDown();
    }
  });

  $(document).on("keydown", function(e) {
    if (scrolling) return;
    if (e.which === 38) {
      navigateUp();
    } else if (e.which === 40) {
      navigateDown();
    }
  });

  $('#main_page').on('click', function() {
    for (var i = curPage; i >= 1; i--) {
      navigateUp();
    }
  });

  $('#contact').on('click', function() {
    for (var i = 1; i <= numOfPages; i++) {
      navigateDown();
    }
  });

  
  
});

// Live search

/*$(document).ready(function() {

  // Обработчик события keyup, сработает после того как пользователь отпустит кнопку, после ввода чего-либо в поле поиска.
  // Поле поиска из файла 'index.php' имеет id='search'
  $("#search").keyup(function() {

    // Присваиваем значение из поля поиска, переменной 'name'.
    var name = $('#search').val();

    // Проверяем если значение переменной 'name' является пустым
    if (name === "") {

      // Если переменная 'name' имеет пустое значение, то очищаем блок div с id = 'display'
      $("#display").html("");

    }
    else {
      // Иначе, если переменная 'name' не пустая, то вызываем ajax функцию.

      $.ajax({

        type: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
        url: "../action-search.php", // Указываем путь к обработчику. То есть указывем куда будем отправлять данные на сервере.
        data: {
          // В этом объекте, добавляем данные, которые хотим отправить на сервер
          search: name // Присваиваем значение переменной 'name', свойству 'search'.
        },
        success: function(response) {
          // Если ajax запрос выполнен успешно, то, добавляем результат внутри div, у которого id = 'display'.
          $("#display").html(response).show();
        }

      });

    }

  });

});
*/

/*function fill(Value) {
  // Функция 'fill', является обработчиком события 'click'.
  // Она вызывается, когда пользователь кликает по элементу из результата поиска.

  $('#search').val(Value); // Берем значение элемента из результата поиска и добавляем его в значение поля поиска

  $('#display').hide(); // Скрываем результаты поиска
}*/


// Расстояние до ближайшего магазина
