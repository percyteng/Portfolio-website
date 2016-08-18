<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
$response = array();
if (isset($_POST['supplier'])&&isset($_POST['address'])&&isset($_POST['district'])&&isset($_POST['numBeds'])&&isset($_POST['features'])&&isset($_POST['price'])) {
    $supplier = $_POST['supplier'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $numBeds = $_POST['numBeds'];
    $features = $_POST['features'];
    $price = $_POST['price'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';
    try{
        // connecting to db
        $con = new DB_CONNECT();
        $db = $con->connect();
        $checkAct = $db->prepare("SELECT * FROM rentalProperties WHERE supplier = :supplier AND address = :address AND price = :price AND district = :district AND type = :numBeds AND features = :features");
        $checkAct->bindParam(":supplier", $supplier);
        $checkAct->bindParam(":address", $address);
        $checkAct->bindParam(":price", $price);
        $checkAct->bindParam(":district", $district);
        $checkAct->bindParam(":numBeds", $numBeds);
        $checkAct->bindParam(":features", $features);
        $checkAct->execute();
        if ($checkAct->rowCount() > 0) {
            // successfully inserted into database
            $responses["success"] = 0;
            $responses["message"] = "This post already exists, you can not create an exactly the same one";
            // echoing JSON response
            echo json_encode($responses);
        }
        else{
            $result = $db->prepare("INSERT INTO rentalProperties(supplier, address, district, type, features, price) VALUES(:supplier, :address, :district, :numBeds, :features, :price)");
            // binding parameters for mysql insertion
            $result->bindParam(":supplier", $supplier);
            $result->bindParam(":address", $address);
            $result->bindParam(":district", $district);
            $result->bindParam(":numBeds", $numBeds);
            $result->bindParam(":features", $features);
            $result->bindParam(":price", $price);
            // mysql inserting a new row with prepared and binded statements
            $result->execute();
            if (!empty($result)) {
                // check for empty result
                if ($result->rowCount() > 0) {
                    $response["success"] = 1;
                    $response["message"] = "post successfully created";
                    // echoing JSON response
                    echo json_encode($response);
                }
                else{
                    $response["success"] = 0;
                    $response["message"] = "Oops! An error occurred.";
                    
                    // echoing JSON response
                    echo json_encode($response);
                }
            }
            else {
                // failed to insert row
                $response["success"] = 0;
                $response["message"] = "Oops! An error occurred.";
                
                // echoing JSON response
                echo json_encode($response);
            }
        } 
    }
    catch (PDOException $e){
        print "Sorry, a database error occurred. Please try again later.\n";
        print $e->getMessage();
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    // echoing JSON response
    echo json_encode($response);
}
?>