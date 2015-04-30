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
//1)
mysqli_query($cxn,"INSERT INTO Member VALUES('$memberID','$Name','$address','$phone','$email','$driverlicense','$credit','$expireDate','2012-12-20')");
//Generate ID!!!!!
//2)
//6)
$locationID='';
$timeStart='';
$timeEnd='';
mysqli_query($cxn,"Select VIN,make,model,year
	from Car LEFT JOIN Reservation
	where locationID=$locationID AND VIN not in(Select UNIQUE VIN
			from Reservation
			where status=active AND ((pick_up_time Between $timeStart AND $timeEnd) OR (return_time BETWEEN $timeStart AND $timeEnd)))");


//1)find all member with registration anniversary on that day 
mysqli_query($cnx,"Select memeberID, name from Member where curdate()>=registration_anniversary_date")
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
mysqli_query($cxn,"Select car.VIN,make,model,year,reservation_number from car left join Reservation on car.VIN=Reservation.VIN where car.current_status='available' AND car.LocationID=$locationID");

//5)
mysqli_query($cxn,"Select VIN,make,model,year,last_odometer_reading from Car where last_odometer_reading-odemeter_reading_of_last_maintenance_check>=5000")

//6) NOT VERY SURE aobut this one
//max
mysqli_query($cxn,"Select * 
from (   
    Select Car.VIN, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_num
	From Car Left join Reservation 
	on Car.VIN=Reservation.VIN
	group by VIN) as T
where rental_num =
(Select min(rental_num)
From(   
    Select Car.VIN, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_num
	From Car Left join Reservation 
	on Car.VIN=Reservation.VIN
	group by VIN) as K)
    ")
//min
mysqli_query($cxn,"Select * 
from (   
    Select Car.VIN, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_num
	From Car Left join Reservation 
	on Car.VIN=Reservation.VIN
	group by VIN) as T
where rental_num =
(Select min(rental_num)
From(   
    Select Car.VIN, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_num
	From Car Left join Reservation 
	on Car.VIN=Reservation.VIN
	group by VIN) as K)
    ")

//7)
$time='';
mysqli_query($cxn,"Select reservation_number, member_ID,locationID from Reservation where pick_up_time=='$time'")

//8)
$response='';
$member_ID='';
$commentID='';
mysqli_query($cxn,"UPDATE Comments SET Response='$response' Where memberID='$member_ID' AND commentID='$commentID'")




?>
    </body>
</html>