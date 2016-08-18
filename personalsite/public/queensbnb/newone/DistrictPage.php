<?PHP

session_start();

if (!(isset($_SESSION['logged']) && $_SESSION['logged'] != '')) {
  header ("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="District.css"> 
    <script src="loginJS.js" type="text/javascript"></script>
  </head>

  <body>
      <header>

    		<ul>
    		 <?php 
            session_start();
            if($_SESSION['logged'] == true){ 
                $name =  $_SESSION["username"];
                echo '<li><a class="active" href="login.php">Hi, '.$name .',  logout</a></li>';
            }
            else {
                echo '<li><a class="active" href="login.php">Hi, logout</a></li>';
            }
          ?>
    		  <li><a href="Profile.php">Profile</a></li>
    		  <li><a href="Help.html">Help</a></li>
    		  <li><a href="home.php">Home</a></li>
    		</ul>
      </header>
      <div class="top" style="background: #66c2ff;">
        <?php 

            $district = $_POST['district'];
            if ($district == null){
              $district = $_SESSION['district'];
            }
            $_SESSION["district"] = $district;
            echo '<h2> District: '.$district.'</h2>';
          ?>
      </div>

      <div style="background: #f2f2f2; no-repeat center center fixed; background-size; cover; -webkit-background-size: cover;">
        <div class="Row">
          <?php 
            $district = $_SESSION['district'];
            require_once __DIR__ . '/db_connect.php';
            try{
                session_start();
                // connecting to db
                $con = new DB_CONNECT();
                $db = $con->connect();
                // mysql inserting a new row
                $result = $db->query("SELECT * FROM rentalProperties WHERE district = '$district' AND avaliable = 'Yes'");
                    if ($result->rowCount() > 0) {
                        foreach ($result as $row) {
                          echo '<form name = "book" action = "book.php" method = "POST" enctype="multipart/form-data">';
                          echo '<div class="Column" style="aligh: left;">';
                          $image = "http://percyteng.com/queensbnb/newone/uploads/" .$row['image'];
                          echo '<img src="'.$image.'" alt="None Image" width="80%" length="80%"; style="position: relative;">';
                          echo '<div style="position: relative; padding: 10px">';
                          echo '<a href="otheruserProfile.php" style="Padding: 5px; border: none;" name = "supplier1">Supplier: '.$row['supplier'].'</a>';
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
                          echo ' <button type="submit" onclick = "">Book</button>';
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
         <!--  <div class="Column" style="aligh: left;">
            <img src="images/u1.jpg" alt="images/u1.jpg" width="80%" length="80%"; style="position: relative;">
            <div style="position: relative;">
              <b style="Padding: 5px;">Address</b> <br> <b style="Padding: 5px;">Price</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">Type</b> <b style="Padding: 5px;">Accomodates:</b> <b># here</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">feature</b>
            </div>
            <div>
              <button type="button">Book</button>
            </div>
          </div>
          <div class="Column"  style="aligh: center;">
            <img src="images/u1.jpg" alt="Pic" width="80%" length="80%"; style="position: relative;">
            <div style="position: relative;">
              <b style="Padding: 5px;">Address</b> <b style="Padding: 5px;">Price</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">Type</b> <b style="Padding: 5px;">Accomodates:</b> <b># here</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">feature</b>
            </div>
            <div>
              <button type="button">Book</button>
            </div>
          </div>
          <div class="Column"  style="aligh: center;">
            <img src="images/u1.jpg" alt="Pic" width="80%" length="80%"; style="position: relative;">
            <div style="position: relative;">
              <b style="Padding: 5px;">Address</b> <b style="Padding: 5px;">Price</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">Type</b> <b style="Padding: 5px;">Accomodates:</b> <b># here</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">feature</b>
            </div>
            <div>
              <button type="button">Book</button>
            </div>
          </div>
        </div>
        <div class="Row">
          <div class="Column" style="aligh: left;">
            <img src="images/u1.jpg" alt="Pic" width="80%" length="80%"; style="position: relative;">
            <div style="position: relative;">
              <b style="Padding: 5px;">Address</b> <b style="Padding: 5px;">Price</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">Type</b> <b style="Padding: 5px;">Accomodates:</b> <b># here</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">feature</b>
            </div>
            <div>
              <button type="button">Book</button>
            </div>
          </div>
          <div class="Column"  style="aligh: center;">
            <img src="images/u1.jpg" alt="Pic" width="80%" length="80%"; style="position: relative;">
            <div style="position: relative;">
              <b style="Padding: 5px;">Address</b> <b style="Padding: 5px;">Price</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">Type</b> <b style="Padding: 5px;">Accomodates:</b> <b># here</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">feature</b>
            </div>
            <div>
              <button type="button">Book</button>
            </div>
          </div>
          <div class="Column"  style="aligh: center;">
            <img src="images/u1.jpg" alt="Pic" width="80%" length="80%"; style="position: relative;">
            <div style="position: relative;">
              <b style="Padding: 5px;">Address</b> <b style="Padding: 5px;">Price</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">Type</b> <b style="Padding: 5px;">Accomodates:</b> <b># here</b>
            </div>
            <div style="position: relative; padding: 10px">
              <b style="Padding: 5px;">feature</b>
            </div>
            <div>
              <button type="button">Book</button>
            </div>
          </div> -->
        </div>
      </div>
  </body>
</html>
