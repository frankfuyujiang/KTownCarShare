<?php
require_once __DIR__ . '/libs/config.php';
if (empty($_POST["LastN"])|| empty($_POST["FirstN"])||empty($_POST["SAddress"])||empty($_POST["City"])||empty($_POST["Province"])||empty($_POST["Country"])||empty($_POST["PhoneNum"])||empty($_POST["Email"])||empty($_POST["ExpireDate"])||empty($_POST["DriverLic"])||empty($_POST["password"])){
    echo "<p>Please fill all the information!</p>";
    $link_address='./registration.php';
    echo "<a href='$link_address'>Go Back!</a>";
}
else{
$LastN=$_POST["LastN"];
$FirstN=$_POST["FirstN"];
$Name=$FirstN." ".$LastN;
$SAddress=$_POST["SAddress"];
$City=$_POST["City"];
$Province=$_POST["Province"];
$Country=$_POST["Country"];

$Address=$SAddress.", ".$City.", ".$Province." ".$Country;
$PhoneNum=$_POST["PhoneNum"];
$Email=$_POST["Email"];
$DriverLic=$_POST["DriverLic"];
$CreditNum=$_POST["CreditNum"];
$ExpireDate=$_POST["ExpireDate"];
$Password=$_POST["password"];

$cxn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}
 //echo "<p>$Name $Address $Email</p>";
mysqli_query($cxn, "INSERT INTO Member VALUES('','$Name','$Address','$PhoneNum','$Email','$DriverLic','$CreditNum','$ExpireDate', DATE(NOW()), '$Password')");
$member_ID=mysqli_fetch_assoc(mysqli_query($cxn,"SELECT * FROM Member WHERE email='$Email'"))['member_ID'];
//echo "<p>$member_ID</p>";
mysqli_query($cxn, "INSERT INTO fee VALUES('$member_ID','250.00','15.00');");
$HOME='./index.php';
    echo "Successfully Register!<br/>";
    echo "<a href='$HOME'>HOME</a>";
}
?>

