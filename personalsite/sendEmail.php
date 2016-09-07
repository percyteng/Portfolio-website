<?php
//if "email" variable is filled out, send email
  if (isset($_POST['emailAddress'])&&isset($_POST['subject'])&&isset($_POST['emailContent']))  {

  //Email information
  $admin_email = "percytsy@gmail.com";
  $email = $_POST['emailAddress'];
  $subject = $_POST['subject'];
  $comment = $_POST['emailContent'];

  //send email
  mail($admin_email, "$subject", $comment, "From:" . $email);

  //Email response
  echo "Thank you for contacting us!";
  }
  
  //if "email" variable is not filled out, display the form
  else  {
	echo "failed";
}
?>
