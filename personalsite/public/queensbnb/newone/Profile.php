<?PHP

session_start();

if (!(isset($_SESSION['logged']) && $_SESSION['logged'] != '')) {
  header ("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="District.css"> 
  </head>

  <body>
      <header>

    		<ul>
    		  <li><a class="active" href="login.php">Logout</a></li>
    		  <li><a href="Profile.php">Profile</a></li>
    		  <li><a href="Help.html">Help</a></li>
    		  <li><a href="home.php">Home</a></li>
    		</ul>
      </header>
      <div class="top" style="background: #66c2ff;">
        <?php 
          session_start();
          if($_SESSION['logged'] == true){ 
              $name =  $_SESSION["username"];
              echo '<h2 style="vertical-align: center;">'.$name.'</h2>';
          }
          else {
              header('Location: http://www.percyteng.com/queensbnb/newone/login.php');
          }
        ?>
      </div>

      <div style="background: #f2f2f2; no-repeat center center fixed; background-size; cover; -webkit-background-size: cover;">
          <div class="pro" style="align: center; background:">
            <div style="position: relative;">
            <?php 
              session_start();
              $name =  $_SESSION["username"];

               require_once __DIR__ . '/db_connect.php';
            try{
                // connecting to db
                $con = new DB_CONNECT();
                $db = $con->connect();
                // mysql inserting a new row
                $result = $db->query("SELECT * FROM serviceMembers WHERE name = '$name'");
                    if ($result->rowCount() > 0) {
                        foreach ($result as $row) {

                          echo '<b style="Padding: 5px;">Email: '.$row['email'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px;">Faculty: '.$row['faculty'].'</b> <b style="Padding: 5px;">Degree: '.$row['degreeType'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px;">Year Graduated: '.$row['year'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px;">Phone number: '.$row['phone_number'].'</b>';
                          echo '</div>';
                        }
                    }
                    else{
                      echo "Sorry, no results found in this district.";
                    }
            } catch (PDOException $e){
                print "Sorry, a database error occurred. Please try again later.\n";
                print $e->getMessage();
            }
            ?>
          </div>
          <div>
          <h4 style="padding: 0px 50px 0px 0px; align: center;   font-size: 30px;">My Bookings:</h4>
        </div>
       <div class="Row">
        <?php 
            require_once __DIR__ . '/db_connect.php';
            try{
                session_start();
                // connecting to db
                $con = new DB_CONNECT();
                $db = $con->connect();
                $name =  $_SESSION["username"];
                // mysql inserting a new row
                $result = $db->query("SELECT * FROM rentalProperties WHERE bookedBy = '$name'");
                    if ($result->rowCount() > 0) {
                        foreach ($result as $row) {
                          $_SESSION["currentUser"] =  $row['supplier'];

                          echo '<form name = "book" action = "otheruserProfile.php" method = "POST" enctype="multipart/form-data">';
                          echo '<div class="Column" style="aligh: left;">';
                          $image = "http://percyteng.com/queensbnb/newone/uploads/" .$row['image'];
                          echo '<img src="'.$image.'" alt="'.$image.'" width="80%" length="80%"; style="position: relative;">';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<input type="hidden" name="supplier" value="'.$row['supplier'].'"/>';
                          echo '<button type ="submit" style="Padding: 5px; border: none;" name = "supplier1" id = "supplier1" href="otheruserProfile.php">Supplier: '.$row['supplier'].'</a>';
                          echo '</form>';
                          echo '<form name = "book" action = "unbook.php" method = "POST" enctype="multipart/form-data">';
                          echo '</div>';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px;">District: '.$row['district'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative;">';
                          echo '<b style="Padding: 5px;" name = "address">Address: '.$row['address'].'</b> <br><br> <b name = "price" style="Padding: 5px;">Price :$'.$row['price'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px;">Type Accomodates:</b> <b>'.$row['type'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px;">Features: '.$row['features'].'</b>';
                          echo '</div>';
                          echo '<div>';
                          echo '<input type="hidden" name="supplier" value="'.$row['supplier'].'"/>';
                          echo '<input type="hidden" name="address" value="'.$row['address'].'"/>';
                          echo '<input type="hidden" name="price" value="'.$row['price'].'"/>';
                          echo '<input type="hidden" name="type" value="'.$row['type'].'"/>';
                          echo '<input type="hidden" name="features" value="'.$row['features'].'"/>';
                          echo ' <button type="submit">Unbook</button>';
                          echo '</div>';
                          echo '</div>';
                          echo '</form>';
                        }
                    }
                    else{
                      echo "You have no booking.";
                    }
            } catch (PDOException $e){
                print "Sorry, a database error occurred. Please try again later.\n";
                print $e->getMessage();
            }
          ?>
        </div>
        <div>
          <h4 style="padding: 0px 110px 0px 0px; align: center;   font-size: 30px;"> Currently Hosting: </h4>
        </div>
        <div class="Row">
          <?php 
            require_once __DIR__ . '/db_connect.php';
            try{
                session_start();
                // connecting to db
                $con = new DB_CONNECT();
                $db = $con->connect();
                $name =  $_SESSION["username"];
                // mysql inserting a new row
                $result = $db->query("SELECT * FROM rentalProperties WHERE supplier = '$name'");
                    if ($result->rowCount() > 0) {
                        foreach ($result as $row) {
                          echo '<form name = "book" action = "deleteHosting.php" method = "POST" enctype="multipart/form-data">';
                          echo '<div class="Column" style="aligh: left;">';
                          $image = "http://percyteng.com/queensbnb/newone/uploads/" .$row['image'];
                          echo '<img src="'.$image.'" alt="'.$image.'" width="80%" length="80%"; style="position: relative;">';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px; border: none;" name = "supplier1" id = "supplier1" >Supplier: '.$row['supplier'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px;">District: '.$row['district'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative;">';
                          echo '<b style="Padding: 5px;" name = "address">Address: '.$row['address'].'</b> <br><br> <b name = "price" style="Padding: 5px;">Price :$'.$row['price'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px;">Type Accomodates:</b> <b>'.$row['type'].'</b>';
                          echo '</div>';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<b style="Padding: 5px;">Features: '.$row['features'].'</b>';
                          echo '</div>';
                          echo '<div>';
                          echo '<input type="hidden" name="supplier" value="'.$row['supplier'].'"/>';
                          echo '<input type="hidden" name="address" value="'.$row['address'].'"/>';
                          echo '<input type="hidden" name="price" value="'.$row['price'].'"/>';
                          echo '<input type="hidden" name="type" value="'.$row['type'].'"/>';
                          echo '<input type="hidden" name="features" value="'.$row['features'].'"/>';
                          echo ' <button type="submit" onclick = "">Delete Hosting</button>';
                          echo '</div>';
                          echo '</div>';
                          echo '</form>';

                        }
                    }
                    else{
                      echo "Sorry, no results found in this district.";
                    }
            } catch (PDOException $e){
                print "Sorry, a database error occurred. Please try again later.\n";
                print $e->getMessage();
            }
          ?>
        
        </div>
      </div>
  </body>
</html>
