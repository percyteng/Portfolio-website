<?PHP

session_start();

if (!(isset($_SESSION['logged']) && $_SESSION['logged'] != '')) {
  header ("Location: login.php");
}
?>
<?php
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
$response = array();
session_start();
    $supplier = $_SESSION['username'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $type = $_POST['type'];
    $features = $_POST['features'];
    $price = $_POST['price'];
    $avaliable = "yes";

    // include db connect class
    require_once __DIR__ . '/db_connect.php';
    try{
        // connecting to db
        $con = new DB_CONNECT();
        $db = $con->connect();
        $checkAct = $db->prepare("SELECT * FROM rentalProperties WHERE supplier = :supplier AND address = :address AND price = :price AND district = :district AND type = :type AND features = :features");
        $checkAct->bindParam(":supplier", $supplier);
        $checkAct->bindParam(":address", $address);
        $checkAct->bindParam(":price", $price);
        $checkAct->bindParam(":district", $district);
        $checkAct->bindParam(":type", $type);
        $checkAct->bindParam(":features", $features);
        $checkAct->execute();
        if ($checkAct->rowCount() > 0) {
            echo "<script type='text/javascript'>alert('Sorry, this post already exists, you cannot create the same post.');</script>";
        }
        else{

          $target_dir = "uploads/";
          $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $message = 'Error uploading file';
            switch( $_FILES['file']['error'] ) {
                case UPLOAD_ERR_OK:
                    $message = false;
                    break;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $message .= ' - file too large (limit of '.get_max_upload().' bytes).';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message .= ' - file upload was not completed.';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message .= ' - zero-length file uploaded.';
                    break;
                default:
                    $message .= ' - internal error #'.$_FILES['file']['error'];
                    break;
            }
            if( !$message ) {
                if( !is_uploaded_file($_FILES['file']['tmp_name']) ) {
                    $message = 'Error uploading file - unknown error.';
                } else {
                    // Let's see if we can move the file...
                    if( !move_uploaded_file($_FILES['file']['tmp_name'], $target_file) ) { // No error supporession so we can see the underlying error.
                        
                        $message = 'Error uploading file - could not save upload (this will probably be a permissions problem in '.$target_file.')';
                        echo "<script type='text/javascript'>alert('".$message."');</script>";
                    } else {
                        $image = $_FILES["file"]["name"];
                        $result = $db->prepare("INSERT INTO rentalProperties(supplier, address, district, type, features, price, avaliable, image) VALUES(:supplier, :address, :district, :type, :features, :price, :avaliable, :image)");
                        // binding parameters for mysql insertion
                        $result->bindParam(":supplier", $supplier);
                        $result->bindParam(":address", $address);
                        $result->bindParam(":district", $district);
                        $result->bindParam(":type", $type);
                        $result->bindParam(":features", $features);
                        $result->bindParam(":price", $price);
                        $result->bindParam(":image", $image);
                        $result->bindParam(":avaliable", $avaliable);

                        // mysql inserting a new row with prepared and binded statements
                        $result->execute();

                        if (!empty($result)) {
                            // check for empty result
                            if ($result->rowCount() > 0) {
                              echo "<script type='text/javascript'>alert('You have created the post and uploaded the image');</script>";
                              header('Location: http://www.percyteng.com/queensbnb/newone/Profile.php');
                            }
                            else{
                              echo "<script type='text/javascript'>alert('You cannot create this post.');</script>";
                            }
                        }
                        else {
                          echo "<script type='text/javascript'>alert('Oops! An error occurred.');</script>";
                        }
                    }
                }
            }
    }
  }
    catch (PDOException $e){
        echo "<script type='text/javascript'>alert('Sorry, a database error occurred. Please try again later.\n');</script>";
    }

?>