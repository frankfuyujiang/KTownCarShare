<?php
include_once('./includes/header.class.php');
?>


<!-- Header and Nav -->
<?php
	include_once('./includes/nav.class.php');
?>

<?php
if (empty($_SESSION['adminID'])){
  echo "<p style='color:red' align='center' size=20>Please Login your account first!</p>";
}
else{

?>
<div class="container">

<table cellspacing="50" align="center">
	<tr><td align="center"><p><b>Welcome to K-Town Car Share</b></p></td></tr>
    <tr><td align="center"><p><a href="./Newcar.php" class="navbar-item" style="">Add a New Car</a></p></td></tr>
    <tr><td align="center"><p><a href="./rentalHistory.php" class="navbar-item" style="">Check Rental History</a></p></td></tr>
    <tr><td align="center"><p><a href="./maintenance.php" class="navbar-item" style="">Need Maintenance</a></p>
</td></tr>
    <tr><td align="center"><p><a href="./stats.php" class="navbar-item" style="">Statistic of Cars</a></p>
</table>
</div>


<?php
}
	include_once('./includes/footer.class.php');
?>

