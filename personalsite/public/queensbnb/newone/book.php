<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

$response = array();
session_start();
    $district = $_SESSION['district'];
    $username = $_SESSION["username"];
    $supplier = $_POST["supplier"];
    $address = $_POST["address"];
    $price = $_POST["price"];
    $type = $_POST["type"];
    $features = $_POST["features"];
    $avaliable = 'no';
//     // include db connect class
    require_once __DIR__ . '/db_connect.php';
    try{
//         // connecting to db
        $con = new DB_CONNECT();
        $db = $con->connect();
        $result = $db->prepare("UPDATE rentalProperties SET bookedBy = :username, avaliable = :avaliable WHERE supplier = :supplier AND address = :address AND price = :price AND type = :type AND features = :features");

        $result->bindParam(":username", $username);
        $result->bindParam(":avaliable", $avaliable);
        $result->bindParam(":supplier", $supplier);
        $result->bindParam(":address", $address);
        $result->bindParam(":price", $price);
        $result->bindParam(":type", $type);
        $result->bindParam(":features", $features);
//         // // mysql executing a new row with prepared and binded statements
        $result->execute();
//         // check if row inserted or not
        if (!empty($result)) {
                header('Location: http://www.percyteng.com/queensbnb/newone/DistrictPage.php');
            }
        else {
            // failed to insert row
            header('Location: http://www.percyteng.com/queensbnb/newone/DistrictPage.php');
        }
//         }
    } catch (PDOException $e){
        header('Location: http://www.percyteng.com/queensbnb/newone/DistrictPage.php');
    }
?>