<?PHP

session_start();

if (!(isset($_SESSION['logged']) && $_SESSION['logged'] != '')) {
  header ("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Host</title>
    <link rel="stylesheet" type="text/css" href="DullStyle.css"> 
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
        <h2>Share Your Place</h2>
      </div>
      <form name = "createPosts" onsubmit="return(checkPosts())" action = "Host.php" method = "POST" enctype="multipart/form-data">
      <div style="background: url(images/u3.jpg) no-repeat center center fixed; background-size; cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
        <div class="s1">
          <div>
          <b>Supplier</b>
          </div>
          <div class="col">
            <?php 
              session_start();
              if($_SESSION['logged'] == true){ 
                  $name =  $_SESSION["username"];
                  echo '<input type="text" name = "supplier" value="'.$name.'" style="height: 40px; width: 400px;" disabled>';
              }
              else {
                  echo '<input type="text" name = "supplier" placeholder = "name of the supplier" style="height: 40px; width: 400px;">';
              }
            ?>
            
          </div>
        </div>
        <div class="s1">
          <div>
          <b>Address</b>
          </div>
          <div class="col">
            <input type="text" name = "address" placeholder="Enter Address" style="height: 40px; width: 400px;readonly">
          </div>
        </div>
        <div class="s2">
          <div>
          <b>District</b>
          </div>
          <div class="col">
            <input type="text" name = "district" placeholder="Enter District" style="height: 40px; width: 400px;">
          </div>
        </div>
        <div class="s3">
          <div>
          <b>Type</b>
          </div>
          <div class="btn-group">
            <label><input class = "radioButton" type="radio" name="type" value="House/Apar" checked="checked" /> House/Apt</label><!--Radio button to determine user's gender -->
            <label><input class = "radioButton" type="radio" name="type" value="Single" /> Single Room</label><br/>
            <label><input class = "radioButton" type="radio" name="type" value="Shared" /> Shared room</label><br/>
          </div>

        </div>
        <div class="s4">
          <div>
          <b>Feature</b>
          </div>
          <div class="col">
            <input type="text" name = "features" placeholder="What's Cool About Your Neighbourhood?" style="height: 40px; width: 400px;">
          </div>
        </div>
        <div class="s5">
          <div>
          <b>Price (per month)</b>
          </div>
          <div class="col">
            <input type="number" name = "price" placeholder="$$$" style="height: 40px; width: 200px;">
          </div>
        </div>
        <div class="s6">
          <div>
            <b>Image: </b>
          </div>
          <div class="col">
            <input type="file" id = "file" name="file" accept="image/*" required> <b>Recommended size: 4x3.</b><br/><br/>
          </div>
        </div>
        <div style="padding: 8px">
        </div>
        <div class="Confirmation">
          <button type="submit" style =" background-color: #00e64d; color: white; padding: 10px 20px; text-align: center; font-family:'Calibri Regular', 'Calibri'; font-size: 20px; border: 0px; border-radius: 50px;">Register Space</button>
        </div>
        <div style="padding: 20px">
        </div>
      </div>
    </form>
  </body>
</html>


