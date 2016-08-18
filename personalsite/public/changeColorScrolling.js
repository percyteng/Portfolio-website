// $(document).ready(function(){   
//   // var myDiv = document.getElementById("content");  
//   // var height = 0;
//   // $('content li').each(function(i, value){
//   //     height += parseInt($(this).height());
//   // });

//   // height += '';

//   // $('content').animate({scrollTop: height});

//    var scroll_start = 0;
//    var sectionTwo = $('#sectionTwo');
//    var sectionThree = $('#sectionThree');
//    var sectionFour = $('#sectionFour');
//    var offsetTop = sectionTwo.offset();
//    var offsetBot = sectionThree.offset();
//    var offsetFour = sectionFour.offset();
//     if (sectionTwo.length){
//    $(document).scroll(function() { 
//       scroll_start = $(this).scrollTop();
//       if(scroll_start > (offsetTop.top) && scroll_start < (offsetBot.top)) {
//           $(".sectionPointers a").css('color', '#25383C');
// 	  $("#nameTitle a").css('color', '#25383C');
//        }
// 	else if(scroll_start>(offsetFour.top)){
// 	  $(".sectionPointers a").css('color', '#0C1E31');
// 	  $("#nameTitle a").css('color', '#0C1E31');
// 	}
// 	 else {
//           $('.sectionPointers a').css('color', '#ffffff');
// 	  $("#nameTitle a").css('color', '#ffffff');
//        }
//    });
//     }
// });
						var nameField = $("#nameField");
						console.log(nameField);
						var realTime = document.forms["realTime"];
						var socket = io();
						$(realTime).submit(function(){
							socket.emit('chat message', nameField.val() + ': ' +$('#m').val());

							$('#m').val('');
							return false;
						});
						socket.on('chat message', function(msg){
							if(msg.indexOf(nameField.val()) > -1){
								$('#messages').append($('<li style = "background-color:#D4D4D4">').text(msg));
							}
							else{
								$('#messages').append($('<li>').text(msg));
							}
							$("#content").scrollTop($("#content")[0].scrollHeight);
						});

							$('#online').submit(function (e) {
							        e.preventDefault();
							        var fd = new FormData($(this)[0]);
							        $.ajax({
							            url: '/getOnline',
							            processData: false,
							            contentType: false,
							            type: 'GET',
							            success: function(data){
							                console.log(data);
							            }
							        });
							});
$(document).ready(function(){
		  // Add smooth scrolling to all links
		  $("a").on('click', function(event) {

		    // Make sure this.hash has a value before overriding default behavior
		    if (this.hash !== "") {
		      // Prevent default anchor click behavior
		      event.preventDefault();

		      // Store hash
		      var hash = this.hash;

		      // Using jQuery's animate() method to add smooth page scroll
		      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		      $('html, body').animate({
		      	scrollTop: $(hash).offset().top
		      }, 800, function(){

		        // Add hash (#) to URL when done scrolling (default click behavior)
		        window.location.hash = hash;
		    });
		    } // End if
		});
		});

			function f(x)
			{
				swal({   title: "Sweet!",   text: "Keep in touch!",   timer: 2000,   showConfirmButton: false,  imageUrl: 'images/profile.jpg',imageWidth: 130,
				imageHeight: 200,
				animation: false });
				return true;
				
			}
$(function() {
  var enter = $("#enter"),
    page1 = $("#nickName"),
    page2 = $("#content"),
    nameField = $("#nameField"),
    nameDisplay = $("#nameDisplay");
    realTimeInput = $("#m");
    realTimeButton = $("#mButton");
    nameField.keypress(function(event){
    if(event.keyCode == 13){
        event.preventDefault();
        enter.click();
    }
	});
  enter.on('click', function() {
    if (nameField.val() == ""){
	alert("Please enter your name for chatting");
    	return false;
    }
    else{
    page1.animate({
      opacity: 0
    }, 100, function() {
      page1.css("display", "none");
      nameDisplay.html("Hello, " + nameField.val() + " :)");
      page2.css("display", "block");
      page2.animate({
        opacity: .7,
      }, 500);
      realTimeInput .animate({
        opacity: .7,
      }, 500);
      realTimeButton .animate({
        opacity: 1,
      }, 500);
    });
    return true;
    }
  });

});


