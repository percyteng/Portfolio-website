<!DOCTYPE html>

<html>
  <head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="Style.css"> 
    <script src="loginJS.js" type="text/javascript"></script>
  </head>

  <body>

    <div id="page-wrap">
      <header>
        <div class="crown">
          <center> <img src="images/crown.png"> </center>
        </div>

      </header>
      <div class="LogIn"> 
        <h2 style="font-family:'Calibri Regular', 'Calibri';">Sign Up</h2>
      </div>
      <form name = "signup" action = "signup.php" onsubmit="return(checkRegistration())" method = "POST" enctype="multipart/form-data"
        <div id="u1" class="ax_text_field">
          <input id="u1_input" type="text" placeholder = "Name" name = "name"/>
        </div>

        <!-- Unnamed (Text Field) -->
        <div id="u2" class="ax_text_field">
          <input id="u2_input" type="text" placeholder = "Email" value="" name = "email"/>
        </div>

        <!-- Unnamed (Text Field) -->
        <div id="u3" class="ax_text_field">
          <input id="u3_input" type="password" placeholder="Password" name = "password"/>
        </div>

        <!-- Unnamed (Text Field) -->
        <div id="u4" class="ax_text_field">
          <input id="u4_input" type="number" placeholder="Phone Number" name = "phone"/>
        </div>

        <!-- Unnamed (Text Field) -->
        <div id="u5" class="ax_text_field">
          <input id="u5_input" type="number" placeholder="Year Graduated " name = "graduateYear"/>
        </div>

        <!-- Unnamed (Text Field) -->
        <div id="u6" class="ax_text_field">
          <input id="u6_input" type="text" placeholder="Faculty " name = "faculty"/>
        </div>

        <!-- Unnamed (Text Field) -->
        <div id="u7" class="ax_text_field">
          <input id="u7_input" type="text" placeholder="Degree Type" name = "degree"/>
        </div>
      
        <div class= "buttons">
            <button type="submit" style =" background-color: #0080ff; color: white; padding: 10px; text-align: center; font-family:'Calibri Regular', 'Calibri'; font-size: 16px; border: 0px; border-radius: 50px;">Complete</button>
            <button type="button" style =" background-color: #0080ff; color: white; padding: 10px; text-align: center; font-family:'Calibri Regular', 'Calibri'; font-size: 16px; border: 0px; border-radius: 50px;" onclick="location.href = 'login.php'">Go Back</button>
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
if (isset($_POST['name']) && isset($_POST['email'])&& isset($_POST['password']) && isset($_POST['phone'])&& isset($_POST['graduateYear'])&& isset($_POST['faculty'])&& isset($_POST['degree'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $graduateYear = $_POST['graduateYear'];
    $faculty = $_POST['faculty'];;
    $degree = $_POST['degree'];;
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
    try{
        // connecting to db
        $con = new DB_CONNECT();
        $db = $con->connect();
        // mysql inserting a new row
        $checkEmail = $db->prepare("SELECT email FROM serviceMembers WHERE email = :email");

        // binding parameters for mysql insertion
        $checkEmail->bindParam(":email", $email);
        // mysql inserting a new row with prepared and binded statements
        $checkEmail->execute();

        // check if row inserted or not
        if ($checkEmail) {
            // check for empty result
            if ($checkEmail->rowCount() > 0) {
                $checkEmail = $checkEmail->fetch();
                $response["success"] = -1;
                $response["message"] = "This email has already been created, please enter another valid email";
                echo "<script type='text/javascript'>alert('This email has already been created, please enter another valid email');</script>";
            }
            else {
                // failed to insert row
                $checkUsername = $db->prepare("SELECT name FROM serviceMembers WHERE name = :name");
                $checkUsername->bindParam(":name", $name);   
                $checkUsername->execute();

                if($checkUsername){
                    if($checkUsername->rowCount()>0){
                        $checkUsername = $checkUsername->fetch();
                        $response["success"] = -1;
                        $response["message"] = "This user name has already been created, please enter another valid user name";
                        echo "<script type='text/javascript'>alert('This user name has already been created, please enter another valid user name');</script>";
                        }
                        else{

                            $result = $db->prepare("INSERT INTO serviceMembers(email, phone_number, year, faculty, degreeType, name, password) VALUES(:email, :phone, :graduateYear, :faculty, :degree, :name, :password)");
                            // binding parameters for mysql insertion
                            $result->bindParam(":email", $email);
                            $result->bindParam(":phone", $phone);
                            $result->bindParam(":graduateYear", $graduateYear);
                            $result->bindParam(":faculty", $faculty);
                            $result->bindParam(":degree", $degree);
                            $result->bindParam(":name", $name);
                            $result->bindParam(":password", $password);
                            // mysql inserting a new row with prepared and binded statements
                            $result->execute();

                            // check if row inserted or not
                            if ($result) {
                                if ($result->rowCount() > 0) {
                                    echo "<script type='text/javascript'>alert('You are now registered.');</script>";
                                    header('Location: http://www.percyteng.com/queensbnb/newone/login.php');
                                    $response["success"] = 1;
                                    $response["message"] = "You are now registered.";
                                    
                                    // successfully inserted into database
                                    // 1 
                                }
                                else{
                                    echo "<script type='text/javascript'>alert('Oops! An error occurred.');</script>";
                                    // failed to insert row
                                    $response["success"] = 0;
                                    $response["message"] = "Oops! An error occurred.";
                                }
                            } else {
                                echo "<script type='text/javascript'>alert('Oops! An error occurred.');</script>";
                                // failed to insert row
                                $response["success"] = 0;
                                $response["message"] = "Oops! An error occurred.";
                                }
                                // echoing JSON response

                        }
                    }
                else {
                    echo "<script type='text/javascript'>alert('Oops! An error occurred.');</script>";
                    // failed to insert row
                    $response["success"] = 0;
                    $response["message"] = "Oops! An error occurred.";
                    
                    // echoing JSON response
                }   
            }
        }
        else {
            echo "<script type='text/javascript'>alert('Oops! An error occurred.');</script>";
            // failed to insert row
            $response["success"] = 0;
            $response["message"] = "Oops! An error occurred.";
        }   
    } catch (PDOException $e){
            echo "<script type='text/javascript'>alert('Oops! An error occurred.');</script>";
            // failed to insert row
            $response["success"] = 0;
            $response["message"] = "Oops! An error occurred.";
    }
} else {
    // echo "<script type='text/javascript'>alert('Something is missing for the database.');</script>";
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Something is missing for database.";
    // echoing JSON response
    // echo json_encode($response);
}
?>