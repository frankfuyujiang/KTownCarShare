<?php
include_once('./includes/header.class.php');
?>


<!-- Header and Nav -->
<?php
	include_once('./includes/nav.class.php');
?>

<div class="container">
<table cellspacing="50" align="center">

	<tr><td align="center"><p><b>Search Your Location</b></p></td></tr>
	<tr>
		<td align="center">
			<br />

			<FORM METHOD="POST" ACTION=".php">
			<div class="col-lg-10">
			<INPUT CLASS="form-control" TYPE="TEXT" NAME = "namer" placeholder="" size="50">
			</div>
			<!-- <INPUT TYPE="submit" VALUE="Search"> -->
			<div class="col-lg-2">
			<button type="submit" class="btn btn-primary">Enter</button>
			</div>
			</FORM>
		</td>
	</tr>
</table>
</div>


<?php
	include_once('./includes/footer.class.php');
?>