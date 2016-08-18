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
          $name =  $_POST["supplier"];
          echo '<h2 style="vertical-align: center;">'.$name.'</h2>';
        ?>
      </div>

      <div style="background: #f2f2f2; no-repeat center center fixed; background-size; cover; -webkit-background-size: cover;">
          <div class="pro" style="align: center; background:">
            <div style="position: relative;">
            <?php 
              session_start();
              $name =  $_POST["supplier"];

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
            } catch (PDOException $e){
                print "Sorry, a database error occurred. Please try again later.\n";
                print $e->getMessage();
            }
            ?>
          </div>
        
        </div>
      </div>
  </body>
</html>
