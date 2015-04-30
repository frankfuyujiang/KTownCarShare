<html>
<head><title>Sample Queries</title></head>
<body>
<?php

 $host = "localhost";
 $user = "jenny1994";
 $password = "815815";
 $database = "KTCS"; 
 $cxn = mysqli_connect($host,$user,$password, $database);
 // Check connection
 if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
/*
user
*/

//1) Register as a new member.
//$memberID= generate
$memberID='AnnieXu94';
$Name='Annie Xu';
$address='187 princess st, kingston';
$phone=6133332894;
$email='3ih2@queensu.ca';
$driverlicense='D61014025661897';
$credit='4520343689890233';
$expireDate='0117';

mysqli_query($cxn,"INSERT INTO Member VALUES('','$Name','$address','$phone','$email','$driverlicense','$credit','$expireDate', DATE(NOW()))");
//Generate ID!!!!!

//2)
$Date=$CURDATE();
mysqli_query($cxn, "insert into Reservation values($reservation_number,$memberID,$VIN,$Date,$locationID,$pick_up_time,'','active',$return_time,'')
   ;");

//4) Show the member’s rental history.
$inputID=100000001;
$result = mysqli_query($cxn, "Select reservation_number, date, pick_up_time, return_time
	From Reservation
    where stauts = 'return' and MemberID=$inputID
    ;")
          or die ("Couldn't execute query.");

//5) Show all locations.
 $result = mysqli_query($cxn, "Select * 
	From Location
    ;")
          or die ("Couldn't execute query.");

//6)
$locationID='1';
$timeStart='2012-03-23';
$timeEnd='2012-03-25';
$result=mysqli_query($cxn,"Select VIN,make,model,year
	from Car LEFT JOIN Reservation
	where locationID=$locationID AND VIN not in(Select UNIQUE VIN
			from Reservation
			where status=active AND ((pick_up_time Between $timeStart AND $timeEnd) OR (return_time BETWEEN $timeStart AND $timeEnd)))");

while($row = mysqli_fetch_assoc($result))
      {
        extract($row);
        echo "$VIN, $make, $model, $year<br />";
      }


//7) Provide a comment on a particular vehicle or on KTCS in general.
//$inputVIN
 $result = mysqli_query($cxn, "Select *
	From Comments
    Where VIN=$inputVIN
    ;")
          or die ("Couldn't execute query.");

mysqli_query($cxn, "insert into Comments values($memberID,$commentID,$VIN,$inputComments,'','active',$return_time,'')
    ;");

/*
admin
*/
//1)find all member with registration anniversary on that day 
mysqli_query($cnx,"Select memeberID, name from Member where curdate()=registration_anniversary_date")
//2)
$VIN='';
$make='';
$model='';
$year=;
$locationID='';

mysqli_query($cxn,"INSERT INTO Car VALUES('$VIN','$make','$model','$year','$locationID','available','0','0','CURDATE()','0')"
//3)
$VIN='';
mysqli_query($cxn,"Select * from Reservation where VIN='$VIN'")

//4)
$locationID='';
mysqli_query($cxn,"Select VIN,make,model,year,reservation_number from Car LEFT JOIN Reservation where Car.current_status=='available'AND LocationID=='$locationID'");

//5)
mysqli_query($cxn,"Select VIN,make,model,year,last_odometer_reading from Car where last_odometer_reading-odemeter_reading_of_last_maintenance_check>=5000")

//6) NOT VERY SURE aobut this one
//max
mysqli_query($cxn,"Select VIN, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_number From Reservation group by VIN Having rental_number=max(rental_number)"
//min
mysqli_query($cxn,"Select VIN, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_number From Reservation group by VIN Having rental_number=min(rental_number)"

//7)
$time='';
mysqli_query($cxn,"Select reservation_number, member_ID,locationID from Reservation where pick_up_time=='$time'")

//8)
$response='';
$member_ID='';
$commentID='';
mysqli_query($cxn,"UPDATE Comments SET Response='$response' Where memberID='$member_ID' AND commentID='$commentID'")



//2) Reserve a car with KTCS.
//

// $result = ;
//$Date=$CURDATE();
//mysqli_query($cxn, "insert into Reservation values($reservation_number,$memberID,$VIN,$Date,$locationID,$pick_up_time,'','active',$return_time,'')
//    ;");
//
////3) Return a car and finish a rental.
////4) Show the member’s rental history.
//$inputID=
// $result = mysqli_query($cxn, "Select reservation_number, date, pick_up_time, return_time
//	From Reservation
//    where stauts = 'return' and MemberID=$inputID
//    ;")
//          or die ("Couldn't execute query.");
//
////
////
//////6) For a given location, show all cars currently available in that location now or at a date and time in the future.
//// $result = mysqli_query($cxn, "Select                                                                            
////	From 
////    group by LocationID
////    ;")
////          or die ("Couldn't execute query.");
////
////
///*
//admin
//*/  
////1) On a given day, find all members whose registration anniversary is that day and must be charged their annual membership fee.
////2) Add a car to the fleet.
////3) Show the rental history for a car.
////4) For a given location, show all cars currently available in that location and reservations for those cars, if any.
////5) Show all cars that have travelled 5000 kms or more since their last scheduled maintenance.
////6) Find the car with the highest/lowest number of rentals.
//
////7) Show all the reservations for a given day.
// $result = mysqli_query($cxn, "Select *
//	From Reservation
//    where Date=$inputDate
//    ;")
////8) Respond to a member’s comment.
//mysqli_query($cxn, "UPDATE Comments
//             SET response='thank you'
//             WHERE member_ID=316740130 and commentID=1;")
?>
    </body>
</html>