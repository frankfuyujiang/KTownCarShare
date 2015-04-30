<?php
include_once('./includes/header.class.php');
?>


<!-- Header and Nav -->
<?php
	require('./includes/nav.class.php');
?>

<?php
	include_once ('./connect.php');
	if(!empty($_SESSION['username'])){
		$member_ID=$_SESSION['member_ID'];
		$result=mysqli_query($cxn,"SELECT * From Member,Reservation where Reservation.member_ID='$member_ID' AND status='in_use'");
		if (mysqli_num_rows($result)===0){
			echo "<h3 align='center'>It seems you have no outstanding vehicle In Use</h3>";
		}else{
			if (empty($_POST['millage'])){
				echo "
				<Form Action='return.php' method='POST'>
				Current Millage:
				<Input type='text' name='millage'>
				<Button type='submit'>Submit</Button>
				</Form>
				";
			}else{
			$reservation=mysqli_fetch_assoc($result);
			$reservationnum=$reservation['reservation_number'];

			$member_ID=$reservation['member_ID'];
			$pickuptime=$reservation['pick_up_time'];
			$returntime=date("Y-m-d H:i:s");

			//echo "<p>".ceil(abs(strtotime($returntime)-strtotime($pickuptime)-60*60*5)/(60*60))."</p>";


			
			$rate=mysqli_fetch_assoc(mysqli_query($cxn,"SELECT * FROM Fee WHERE member_ID='$member_ID'"))['usage_fee'];

			
			$pay=floor((abs(strtotime($returntime)-strtotime($pickuptime))/(60*60))*$rate);
			$millage=$_POST['millage'];


			//echo "<p>$rate $millage $pickuptime $returntime $member_ID</p>";
			mysqli_query($cxn,"UPDATE Reservation SET status='return',odometer_reading_at_return='$millage',return_time='$returntime' WHERE reservation_number='$reservationnum'");
			echo "<p align='center'> The total payment is $".$pay.". And it will be charged automatically through your credit card.</p>";
			echo "<h3 align='center'>Thank You for Car Sharing with Us</h3>";
			}
		}
	}else{
		echo "<h3 align='center'>You have not logged in yet.</h3>";
	}
?>
<a align="right" href='index.php'>go back</a>


<?php
	include_once('./includes/footer.class.php');
?>