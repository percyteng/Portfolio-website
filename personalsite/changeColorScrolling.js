$(document).ready(function(){       
   var scroll_start = 0;
   var sectionTwo = $('#sectionTwo');
   var sectionThree = $('#sectionThree');
   var offsetTop = sectionTwo.offset();
   var offsetBot = sectionThree.offset();
    if (sectionTwo.length){
   $(document).scroll(function() { 
      scroll_start = $(this).scrollTop();
      if(scroll_start > offsetTop.top && scroll_start < offsetBot.top) {
          $(".sectionPointers a").css('color', '#0C1E31');
	  $("#nameTitle a").css('color', '#0C1E31');
       } else {
          $('.sectionPointers a').css('color', '#ffffff');
	  $("#nameTitle a").css('color', '#ffffff');
       }
   });
    }
});