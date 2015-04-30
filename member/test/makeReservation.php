<?php
include_once('connect.php');

if(isset($_POST['VIN'])){
$member_ID=$_SESSION['member_ID']
$VIN=$_POST['VIN'];
$date=date("Y-m-d H:i:s");
$locationID=$_POST['locationID'];
$pick_up_time=$_POST['starttime'];
$return_time=$_POST['endtime'];

if(mysqli_query($cxn,"INSERT INTO Reservation values ('56478','$member_ID','$VIN','$date','$locationID','$pick_up_time','654','active','$return_time','')")){
echo "<h1 align='center'> The Booking was successful! You will be redirected to the home page in 5 sec...</h1>";
header('Refresh: 5; URL=localhost/member/index.php');
}else{
	echo "<h1 align='center'> The Booking was NOT successful. You will be redirected to the booking page in 5sec...</h1>";
	header('Refresh: 5; URL=localhost/member/location.php');
}

/*


    $VIN=$_POST["cars"];
    $member_ID=$_SESSION['member_ID'];
    $Start=$_COOKIE['StartTime'];

//    if ($_SERVER["REQUEST_METHOD"] == "POST"){
//        $VIN= test_input($_POST["cars"]);
//        
//            }
//    function test_input($data) {
//       $data = trim($data);
//       $data = stripslashes($data);
//       $data = htmlspecialchars($data);
//       return $data;
//    }

echo "$VIN VIN!!!  $member_ID hhhh $Start and $End" ;

//mysqli_query($cxn, "INSERT INTO reservation_number")
//$result=mysqli_query($cxn, "INSERT INTO Member VALUES('','$Name','$Address','$PhoneNum','$Email','$DriverLic','$CreditNum','$ExpireDate', DATE(NOW()))")
*/
?>

