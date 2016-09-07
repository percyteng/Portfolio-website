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

console.log($(window).width());
if($(window).width() > 765) {
		var posXc,
				posYc,
				posXs,
				posYs,

				divElement,
				paused = null,
				size,
				rad,
				randColor,
				colArray =["#B6B6B4","#E77471","#F9D700"],
				lastScrolledLeft = 0,
				lastScrolledTop = 0;

		$(document).mousemove(function(event) {
				captureMousePosition(event);
		})

				$(window).scroll(function(event) {
						if(lastScrolledLeft != $(document).scrollLeft()){
								posXc -= lastScrolledLeft;
								lastScrolledLeft = $(document).scrollLeft();
								posXc += lastScrolledLeft;
						}
						if(lastScrolledTop != $(document).scrollTop()){
								posYc -= lastScrolledTop;
								lastScrolledTop = $(document).scrollTop();
								posYc += lastScrolledTop;
						}

				});
		function captureMousePosition(event){
				posXc = event.pageX -5;
				posYc = event.pageY -5;

		}

		function createCircle(divElement){

						size=Math.floor((Math.random() * 10) + 5);
						randColor=Math.floor((Math.random() * 3) + 0);
						rad = Math.floor(size/2);
						divElement.style.opacity="0.7";
						divElement.className="circle";
						divElement.style.width =size+"px";
						divElement.style.height = size+"px";
						divElement.style.borderRadius = rad+"px";
						divElement.style.background = colArray[randColor];
						divElement.style.zIndex ="1";
						divElement.style.animation ="smooth 0.5s ease-in"


		}
		function createSquare(){
						size=Math.floor((Math.random() * 15) + 5);
						randColor=Math.floor((Math.random() * 3) + 0);
						divElement.style.opacity="0.5";
						divElement.className="square";
						divElement.style.width =size+"px";
						divElement.style.height = size+"px";
						divElement.style.background = colArray[randColor];
						divElement.style.zIndex ="1";
						divElement.style.animation ="smooth 0.5s ease-in"

		}
		$(document).ready(function () {

		$("html").mousemove(function (e) {

				divElement =document.createElement("Div");
				//divElementSqr = document.createElement("Div");
				createCircle(divElement);
				//createSquare(divElementSqr);

				//posXs=e.clinetX +10;
				//posXs=e.clinetY +10;
				if (!paused){
				document.getElementsByTagName("body")[0].appendChild(divElement);
				/*
				$(divElementSqr).css({position:"absolute", top:posYs,left:posXs}).delay(1000).hide(100, function() {
						$(this).fadeOut(200);
						$(this).remove();
				});
				*/
			 $(divElement).css({position:"absolute", top:posYc,left:posXc}).delay(400).hide(500, function() {
						$(this).fadeOut(400);
						$(this).remove();
				});
				paused = setTimeout(function(){paused=null}, 20);
				}
		});
	});
}
/*
										d
						divElement.style.transition ="all 3s ease-in-out;"
*/

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
