<?php
include_once('./includes/header.class.php');
?>


<!-- Header and Nav -->
<?php
	include_once('./includes/nav.class.php');
?>
	

<div class="container">

<table cellspacing="50" align="center">
	<!--<tr><td align="center"><a href='./location'><button class='btn btn-primay'>Make Reservation</button></a></td></tr> 
	<tr><td><br/><br/></td></tr>-->
	<tr><td align="center"><p><b>Add a New Car</b></p></td></tr>
	<tr>
		<td align="center">
			<br />
			<FORM METHOD="POST" ACTION="addcar.php">
			<div class="col-lg-12" align="left">
                VIN:<INPUT CLASS="form-control" TYPE="TEXT" NAME = "VINin" size="20"/>
                Make: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "makein" placeholder="make" size="20"/>
                Model: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "modelin" placeholder="Model" size="20"/>
                Year: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "yearin" size="20"/>
                LocationID: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "locationin" placeholder="LocationID" size="20"/>
                Current Status: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "status" size="20"/>
                Last Odometer Reading: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "lastOR" size="20"/>
                Last Gas Tank Reading: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "lastGT" size="20"/>
                Date of Last Maintenance Check: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "DateCheck" size="20"/>
                Odometer Reading of Last Maintenance Check: <INPUT CLASS="form-control" TYPE="TEXT" NAME = "MainCheck" size="20"/>
                </div>
			<br>
			<div>
			<button type="submit" class="btn btn-primary">Add</button>
			</div>

			</FORM>
		</td>
	</tr>
</table>
</div>
<?php
	include_once('./includes/footer.class.php');
?>

</body>