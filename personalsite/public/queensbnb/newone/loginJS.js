function isEmpty(){
	var x = document.forms["login"]["email"].value
	var y = document.forms["login"]["password"].value
  if(x == "")
  {
    alert("Please enter an email address");
    return false;
  }
  else if( y == ""){
    alert("Please enter a password");
    return false;
  }
    return true;
}
function checkRegistration(){
	var name = document.forms["signup"]["name"].value
	var email = document.forms["signup"]["email"].value
	var password = document.forms["signup"]["password"].value
	var phone = document.forms["signup"]["phone"].value
	var graduateYear = document.forms["signup"]["graduateYear"].value
	var faculty = document.forms["signup"]["faculty"].value
	var degree = document.forms["signup"]["degree"].value
  if(name == "")
  {
    alert("Please enter a user name");
    return false;
  }
  else if(email == "" || email.indexOf("@") == -1){
    alert("Please enter a valid email address");
    return false;
  }
    else if(password == ""){
    alert("Please enter your password");
    return false;
  }
    else if(phone == ""){
    alert("Please enter your phone number");
    return false;
  }
    else if(graduateYear == ""){
    alert("Please enter the year you graduated");
    return false;
  }
    else if(faculty == ""){
    alert("Please enter your faculty in university");
    return false;
  }
    else if(degree == ""){
    alert("Please enter your degree");
    return false;
  }
  return true;
}

function checkPosts(){
  var supplier = document.forms["createPosts"]["supplier"].value
  var address = document.forms["createPosts"]["address"].value
  var district = document.forms["createPosts"]["district"].value
  var feature = document.forms["createPosts"]["feature"].value
  var price = document.forms["createPosts"]["price"].value
  if(supplier == "")
  {
    alert("Please enter a supplier name");
    return false;
  }
    else if(address == ""){
    alert("Please enter the address");
    return false;
  }
    else if(district == ""){
    alert("Please enter the district");
    return false;
  }
    else if(feature == ""){
    alert("Please enter the feature of your place");
    return false;
  }
    else if(price == ""){
    alert("Please enter a valid price (digits only)");
    return false;
  }
  return true;
}
