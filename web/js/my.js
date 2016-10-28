//при нажатии на миниатюру
$('#thumb img').click(function(){
  //удаляем класс active с другой миниатюры
  $('#thumb img').removeClass("active");
  //добавляем класс active к миниатюре на которую мы нажали
  $(this).addClass("active");
  //получаем у неё значение атрибута src и присваиваем его атрибуту src с id="preview"
  $("#preview").attr("src",$(this).attr("src"));
});
//для слайдера
$(function(){

    $('#slider3').Thumbelina({
        orientation:'vertical',         // Use vertical mode (default horizontal).
        $bwdBut:$('#slider3 .top'),     // Selector to top button.
        $fwdBut:$('#slider3 .bottom')   // Selector to bottom button.
    });

});
$(window).scroll(function() {
  if ($(this).scrollTop() > 11){
    $('header').addClass("fixed");
}
  else{
    $('header').removeClass("fixed");
      }
});
