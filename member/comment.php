<?php
include_once('./includes/header.class.php');
?>
<style type="text/css">
.wrap {
	display:inline-block;
    width:300px;
    height:310px;
    margin:20px;
    padding:20px;
    border:1px solid #c2c0b8;
    background-color:#fff;
    -webkit-box-shadow:0 0 60px 10px rgba(0, 0, 0, .1) inset, 0 5px 0 -4px #fff, 0 5px 0 -3px #c2c0b8, 0 11px 0 -8px #fff, 0 11px 0 -7px #c2c0b8, 0 17px 0 -12px #fff, 0 17px 0 -11px #c2c0b8;
    -moz-box-shadow:0 0 60px 10px rgba(0, 0, 0, .1) inset, 0 5px 0 -4px #fff, 0 5px 0 -3px #c2c0b8, 0 11px 0 -8px #fff, 0 11px 0 -7px #c2c0b8, 0 17px 0 -12px #fff, 0 17px 0 -11px #c2c0b8;
    box-shadow:0 0 60px 10px rgba(0, 0, 0, .1) inset, 0 5px 0 -4px #fff, 0 5px 0 -3px #c2c0b8, 0 11px 0 -8px #fff, 0 11px 0 -7px #c2c0b8, 0 17px 0 -12px #fff, 0 17px 0 -11px #c2c0b8;
}
.wrap img {
    width: 100%;
    margin-top: 15px;
}



h2{
    font-size: 20px;
    font-weight: bold;
    margin-top: 5px; 
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
}


.container{
	background-color:RGBA(79, 213, 214,0.8);
	border: 1px solid #ddd;
	display: center;
	width: 630;
}

</style>
<!-- Header and Nav -->
<?php
	require('./includes/nav.class.php');
	include_once('connect.php');



	if(!empty($_POST)){
		if(!empty($_SESSION['member_ID'])){
			$member_ID=$_SESSION['member_ID'];
			$commentID=mysqli_fetch_assoc(mysqli_query($cxn,"SELECT max(commentID) as maxID from comments where member_ID='$member_ID'"))['maxID']+1;
			$PostTime=date("Y-m-d H:i:s");
			if(!empty($_POST['comment'])){
				$commentString=$_POST['comment'];
				if(!empty($_POST['ReservationN'])){
					$reservation=$_POST['ReservationN'];
					$vins=mysqli_query($cxn,"SELECT * FROM reservation WHERE reservation_number='$reservation'");
					if(mysqli_num_rows($vins)===0){
						echo "<p style='color:red' align='center'>No Such Reservation Exists, Please Re-enter</p>";
					}else{
						$vin=mysqli_fetch_assoc($vins)['VIN'];
						//echo "<p>ran</p>";
						mysqli_query($cxn,"INSERT into comments values('$commentID','$member_ID','$PostTime','$vin','$commentString','')");
					}
				}else{
					$reservation=$_POST['ReservationN'];
					$vin=NULL;
					mysqli_query($cxn,"INSERT into comments values('$commentID','$member_ID','$PostTime','$vin','$commentString','')");
				}
				
			}else{
				echo "<p style='color:red' align='center'>Comment text box can not be left blank</p>";
			}
		}else{
			echo "<p style='color:red' align='center'>Please log in to leave a comment</p>";
		}
	}

?>
	



<div class="container">

<table width="600" align="center">

	<tr>
		<td align="center" >
			<br />
			<FORM METHOD="POST" ACTION="Comment.php">
			<div class="col-lg-12" align="left">
			Reservation Number: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "ReservationN" placeholder="Reservation Number, leave blank if it is a comment to the company" size="20"/>
			Comments: <textarea CLASS="form-control" TYPE="TEXTBOX" style="resize:none" NAME = "comment" placeholder="Leave us a Comment" rows="5"/></textarea>
			<br/>
			</div>
			<input type="submit" class="btn btn-primary" name="submit" value="Submit" align="center">
			</FORM>
		</td>
</table>
</div>

<div align="center">
	<?php
	$comments=mysqli_query($cxn,"SELECT * FROM COMMENTS order by PostTime DESC");

	$comment['commentString']="hii this place was realy easy and convenient definitely would rent from here again.";
	$comment['PostTime']=date("Y-m-d H:i:s");
		while($comment=mysqli_fetch_assoc($comments)){
			$member_ID=$comment['member_ID'];
			$name=mysqli_fetch_assoc(mysqli_query($cxn,"SELECT * FROM member where member_ID='$member_ID'"))['Name'];
			if(empty($comment['VIN'])){
				$about="KTCS";
			}else{
				$vin=$comment['VIN'];
				$car=mysqli_fetch_assoc(mysqli_query($cxn,"SELECT * FROM car where VIN='$vin'"));
				$about=$car['make']." ".$car['model']." ".$car['year'];
			}
			$PostTime=$comment['PostTime'];
			$response=$comment['response'];
			$commentString=$comment['commentString'];
			echo "<div class='wrap'>
				<div style='display:inline'>
				<div style='float:left' ><p>$name said:</p></div>
				<div style='float:right' ><p>$PostTime</p></div>
				</div>
				<div align='left'><p>about $about</p></div>
				<div><h2>$commentString</h2></div>
				</div>";
		}
	?>

</div>
<?php
	include_once('./includes/footer.class.php');
?>

</body>