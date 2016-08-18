<?PHP

session_start();

if (!(isset($_SESSION['logged']) && $_SESSION['logged'] != '')) {
  header ("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="StyleSite.css"> 
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
            header('Location: http://www.percyteng.com/queensbnb/newone/login.php');
        }
      ?>
<!-- 		  <li><a class="active" href="login.php">Logout</a></li> -->
		  <li><a href="Profile.php">Profile</a></li>
		  <li><a href="Help.html">Help</a></li>
		  <li><a href="HostPage.php">Host</a></li>
		</ul>
      </header>
      	<div class="crown">
          <center> <img src="images/crown.png"> </center>
        </div>
        <div class="Page Title">
          <h1 style="font-family:'Calibri Regular', 'Calibri'; color: white;">QBNB</h1>
        <div>
        <center><div class="search ">
        	<div>
        		<h3>Where Are You Going?</h3>
        	</div>
          <form name = "login" onsubmit="return(isEmpty())" action = "DistrictPage.php" method = "POST" enctype="multipart/form-data">
          	<div class="searchBar">
                <div class="col-sm-10">
                    <input type="search"  id="search" name="district" placeholder="Enter a District" style="height: 50px; width:500px;" required>
                </div>
            	</div>
            	<div class="searchButton">
  	          	<button type="submit" style ="background-color: #0080ff; color: white; padding: 10px 20px; text-align: center; font-family:'Calibri Regular', 'Calibri'; font-size: 17px; border: 0px; border-radius: 10px;">Search</button>
  	        </div>
          </form>

        </div> </center>

  </body>
</html>
