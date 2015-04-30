<?php
require_once __DIR__ . '/libs/config.php';
if (empty($_POST["LastN"])|| empty($_POST["FirstN"])||empty($_POST["SAddress"])||empty($_POST["City"])||empty($_POST["Province"])||empty($_POST["Country"])||empty($_POST["PhoneNum"])||empty($_POST["Email"])||empty($_POST["Code"])||empty($_POST["passwordinput"])){
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
$Address=$SAddress.", ".$City.", ".$Province.", ".$Country;
$PhoneNum=$_POST["PhoneNum"];
$Email=$_POST["Email"];
$Registercode=$_POST["Code"];
$Password=$_POST["passwordinput"];

$cxn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}
if ($Registercode=='BeautifulKingston'){
$result=mysqli_query($cxn, "INSERT INTO Admin VALUES('','$Name','$Address','$PhoneNum','$Email','$Password')");
    $HOME='./index.php';
    echo "Successfully Register!<br/>";
    echo "<a href='$HOME'>HOME</a>";
}
else{
    echo "<p>Register Code is wrong. Please check it again.</p>";
    $link_address='./registration.php';
    echo "<a href='$link_address'>Go Back!</a>";
}
}



?>

