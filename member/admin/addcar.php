<?php
require_once __DIR__ . '/libs/config.php';
if (empty($_POST["VINin"])|| empty($_POST["makein"]) ||empty($_POST["modelin"]) ||empty($_POST["yearin"]) ||empty($_POST["locationin"]) ||empty($_POST["status"]) ||empty($_POST["lastOR"]) ||empty($_POST["lastGT"]) ||empty($_POST["DateCheck"]) ||empty($_POST["MainCheck"])){
    echo "<p>Please fill all the information!</p>";
    $link_address='./Newcar.php';
    echo "<a href='$link_address'>Go Back!</a>";
}
else{
    $VIN=$_POST["VINin"];
    $make=$_POST["makein"];
    $model=$_POST["modelin"];
    $year=$_POST["yearin"];
    $locationID=$_POST["locationin"];
    $current_status=$_POST["status"];
    $last_odometer_reading=$_POST["lastOR"];
    $last_gas_tank_reading=$_POST["lastGT"];
    $date_of_last_maintenance_check=$_POST["DateCheck"];
    $odometer_reading_of_last_maintenance_check=$_POST["MainCheck"];

    $cxn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE);
    if (mysqli_connect_errno())
    {echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
    }
    
    $space=mysqli_query($cxn, "select number_of_space from  Location    WHERE locationID=$locationID");
    
    if ($space===0){
        echo "<p>This location is full. Please add the car to another location. Thank you!</p>";
        $link_address='./Newcar.php';
        echo "<a href='$link_address'>Go Back!</a>";
    }
else{
    $result=mysqli_query($cxn, "INSERT INTO Car VALUES('$VIN','$make','$model','$year','$locationID','$current_status','$last_odometer_reading','$last_gas_tank_reading','$date_of_last_maintenance_check','$odometer_reading_of_last_maintenance_check')");

    mysqli_query($cxn, "UPDATE Location
    SET number_of_space=number_of_space-1
    WHERE locationID=$locationID");

    echo "<p>The car has been added successfully!</p>";
    $link_address='./CarIndex.php';
    echo "<a href='$link_address'>Back</a>";    
    
}
}
    header("./index.php");
?>

