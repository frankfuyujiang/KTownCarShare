<?php
include_once('./includes/header.class.php');
?>


<!-- Header and Nav -->
<?php
	require('./includes/nav.class.php');
?>
<?php
if (empty($_SESSION)){
?>
<div class="container">

<table cellspacing="50" align="center">
	<!--<tr><td align="center"><a href='./location'><button class='btn btn-primay'>Make Reservation</button></a></td></tr> 
	<tr><td><br/><br/></td></tr>-->
	<tr><td align="center"><p><b>Register</b></p></td></tr>
	<tr>
		<td align="center">
			<br />


			<FORM METHOD="POST" ACTION="addAdmin.php">
			<div class="col-lg-12" align="left">
			Name:<INPUT CLASS="form-control" TYPE="TEXT" NAME = "LastN" placeholder="Last Name" size="20"/>
				<INPUT CLASS="form-control" TYPE="TEXT" NAME = "FirstN" placeholder="First Name" size="20"/>
			</div>
			<br />
			<div class="col-lg-12" align="left">
			Street Address:<Input class="form-control" Type="TEXT" NAME="SAddress" placeholder="Address" size="20"/>
			<br>
			<Input class"form-control" Type="TEXT" Name="City" placeholder="City" size="15"/>
			<Input class"form-control" Type="TEXT" Name="Province" placeholder="Province" size="15"/>
			<br>
			<Input class"form-control" Type="TEXT" Name="Country" placeholder="Country" size="15"/>
			
			</div>
			<br>
			<div class="col-lg-12" align="left">
			Phone Number: <Input class="form-control" Type="TEXT" NAME="PhoneNum" placeholder="(123)456-7890" size="20"/>
			</div>
			<br>
			<div class="col-lg-12" align="left">
			Email: <Input class="form-control" Type="TEXT" NAME="Email" placeholder="123@ktcs.com" size="20"/>
			</div>
			<br>
                <div>
                Password: <Input class="form-control" Type="TEXT" NAME="passwordinput" size="20"/>
                </div>
			<br>
                <div>
                Register Code: <Input class="form-control" Type="TEXT" NAME="Code" size="20"/>
                </div>
			<br>
			<div>
			<button type="submit" class="btn btn-primary">Register</button>
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

<?php
}else{
	echo "<h2 align='center'>You have already logged in</h2>";
	echo "<h2 align='center'>Please Log out first to register another account</h2>";
}