<?PHP
session_start();
$_SESSION["logged"] = false;
?>
<!doctype html>
<html>
  <head>
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="Style.css"> 
    <script src="loginJS.js" type="text/javascript"></script>
  </head>

  <body>

    <div id="page-wrap">
      <header>
        <div class="crown">
          <center> <img src="images/crown.png"> </center>
        </div>
        <div class="Page Title">
          <h1 style="font-family:'Calibri Regular', 'Calibri';">WELCOME TO QBNB</h1>
        <div>
      </header>
      <form name = "login" onsubmit="return(isEmpty())" action = "login.php" method = "POST" enctype="multipart/form-data">
        <div class="LogIn"> 
          <h2 style="font-family:'Calibri Regular', 'Calibri';">Log In</h2>
        </div>
        <div class= "email">
             <div class="form-group">
                <label for="email" class="col-sm-2 control-label" style="font-family:'Calibri Regular', 'Calibri';"><b>Email</b></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" >
                </div>
            </div>
        </div>
        <div class= "Password">
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label" style="font-family:'Calibri Regular', 'Calibri';"><b>Password</b></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
        </div>
        <div class= "buttons">
          <button type="submit" id = "loginButton"style =" background-color: #0080ff; color: white; padding: 10px; text-align: center; font-family:'Calibri Regular', 'Calibri'; font-size: 16px; border: 0px; border-radius: 50px;">Log In</button>
          <button type="button" style =" background-color: #0080ff; color: white; padding: 10px; text-align: center; font-family:'Calibri Regular', 'Calibri'; font-size: 16px; border: 0px; border-radius: 50px;" onclick="location.href = 'signup.php';">Sign Up</button>
      </div>
  </form>
  </body>
</html>


<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
$response = array();
if (isset($_POST['email']) && isset($_POST['password'])) {
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
    try{
        // connecting to db
        $con = new DB_CONNECT();
        $db = $con->connect();
        // mysql inserting a new row
        $result = $db->prepare("SELECT name FROM serviceMembers WHERE email = :email AND password = :password");
        // binding parameters for mysql insertion
        $result->bindParam(":email", $email);
        $result->bindParam(":password", $password);
        // mysql inserting a new row with prepared and binded statements
        $result->execute();
        // check if row inserted or not
        if ($result) {
            // check for empty result
            if ($result->rowCount() > 0) {
                $result = $result->fetch();
                $_SESSION["username"] = $result["name"];
                $_SESSION["logged"] = true;
                header('Location: http://www.percyteng.com/queensbnb/newone/home.php');
                
                // $response["success"] = 1;
                // $response["message"] = "Successfully found the user";
                // $response["user"] = $result["name"];
                // echo json_encode($response);
            }
         else {
            $_SESSION["logged"] = false;
            echo "<script type='text/javascript'>alert('Sorry, you entered incorrect email adress or password.');</script>";
            // header('Location: http://www.percyteng.com/queensbnb/newone/login.html');
            // $response["success"] = 0;
            // $response["message"] = "Oops! An error occurred.";
            // echo json_encode($response);
        }
    }
    } catch (PDOException $e){
        print $e->getMessage();
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    // echoing JSON response
}
?>