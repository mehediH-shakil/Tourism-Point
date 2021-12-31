$(document).ready(function() {

      $(window).scroll(function() {   
            var scroll = $(window).scrollTop();

            if (scroll >= 60) {
                  $(".navbar").addClass("bg-light");
            } else {
                  $(".navbar").removeClass("bg-light");
            }
      }); 
});