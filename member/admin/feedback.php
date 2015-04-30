<?php
include_once('./includes/header.class.php');
?>
<?php
	require('./includes/nav.class.php');
?>
<?php
if (empty($_SESSION['adminID'])){
  echo "<p style='color:red' align='center' size=20>Please Login your account first!</p>";
}
else{

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



h4{
    font-size: 12px;
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



	



<div class="container">

<table width="600" align="center">

	<tr>
		<td align="center">
			<br />
			<FORM METHOD="POST" ACTION="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="col-lg-12" align="left">
			MemberID: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "Member" placeholder="MemberID" size="20"/>
            CommentID: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "Comment" placeholder="CommentID" size="20"/>

			Response: <textarea CLASS="form-control" TYPE="TEXTBOX" style="resize:none" NAME = "response" placeholder="Response" rows="5"/></textarea>
			<br/>
			</div>
			<input type="submit" class="btn btn-primary" name="submit" value="Submit" align="center">
			</FORM>
		</td>
		</tr>
	<tr><td align="center"><p><b> </b></p></td></tr> <!-- display -->
	</tr>
</table>
</div>

<?php /*
$RMemberID='$Member';
$RcommentID='$Comment';
$responseUp='$response';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $RMemberID=test_input($_POST["Member"]);
    $RcommentID=test_input($_POST["Comment"]);
    $responseUp=test_input($_POST["response"]);
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
        }*/
?>


<?php
	include_once('connect.php');


	if(!empty($_POST)){
		if ((!empty($_SESSION['Member'])) || (!empty($_POST['Comment'])) || (!empty($_POST['response']))) {
					$responseUp=$_POST['response'];
					$memberID=$_POST['Member'];
					$commentID=$_POST['Comment'];
					mysqli_query($cxn,"Update Comments set response='$responseUp' where member_ID='$memberID' and commentID='$commentID'");
			}
			else{
				echo "<p style='color:red' align='center'>Please fill in all the text box!</p>";
			}
    
//		else{
//			echo "<p style='color:red' align='center'>Please log in to leave a comment</p>";
//		}
    }
	

?>


<div align="center">
	<?php
	$comments=mysqli_query($cxn,"SELECT * FROM COMMENTS order by PostTime DESC");

	$comment['commentString']="hii this place was realy easy and convenient definitely would rent from here again.";
	$comment['PostTime']=date("Y-m-d H:i:s",strtotime("-5 hours"));
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
            $commentID=$comment['commentID'];
			$PostTime=$comment['PostTime'];
			$response=$comment['response'];
			$commentString=$comment['commentString'];
			echo "<div class='wrap'>
				<div>
                <div style='float:left' ><p>MemberID: $member_ID</p></div>      
                <div style='float:right' >CommentID: $commentID</p></div>
				<div style='float:left' ><p>$name said:</p></div>
				<div style='float:right' ><p>$PostTime</p></div>
				</div>
				<div align='left'><p>about $about</p></div>
				<div><h4>$commentString</h4></div>
                <div align='left'><p>Response:</p></div>
                <div><h4>$response</h4></div>
                </div>";
		}
	?>

</div>
<?php
    }
	include_once('./includes/footer.class.php');
?>

</body>