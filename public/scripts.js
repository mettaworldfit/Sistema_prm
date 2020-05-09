$(document).ready(function () {

  /**
   *  Menú movil 
   */

  $('.menu-movil').on('click', function () {
    $('.site-nav ul').slideToggle('slow');

  });

  /**
  *   Header menu
  */
 
    $(window).scroll(function () {

     if ($(this).scrollTop() > 500){
      
        $('.contenido').css("position","fixed");
    

      } else if ($(this).scrollTop() > 0) {
        $('.contenido').css("position","relative");
      }
     
    });
   
  });
