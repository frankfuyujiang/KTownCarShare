<?php
include('./includes/header.class.php');
?>

<style type="text/css">

.rwd-table {
  margin: 1em 0;
  min-width: 300px; 
  }
  .rwd-table tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
  }
  
 .rwd-table th {
    display: none;
  }
  
  .rwd-table td {
    display: block; 
    }

    .rwd-table td:first-child {
      padding-top: .5em;
    }
    .rwd-table td::last-child {
      padding-bottom: .5em;
    }
  .rwd-table th, td {
    text-align: center;
    display: table-cell;
    padding: .5em .5em;
  }
.rwd-table th, td:first-child {
        padding-left: 0;
      }
      
.rwd-table th, td:last-child {
        padding-right: 0;
      }



// presentational styling

@import 'http://fonts.googleapis.com/css?family=Montserrat:300,400,700';

body {
  padding: 0 2em;
  font-family: Montserrat, sans-serif;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  color: #444;
  background: #eee;
}


.rwd-table {
  background: #0099CC;
  color: #fff;
  border-radius: .4em;
  overflow: hidden;
}
 .rwd-table tr {
    border-color: lighten(#34495E, 10%);
  }
 .rwd-table th, td {
    margin: 1em 1em;
  }

.rwd-table th, td:before {
    color: #000000;
 }
</style>

<!-- Header and Nav -->
<?php	
require('./includes/nav.class.php');
?>
<?php
if (empty($_SESSION['adminID'])){
  echo "<p style='color:red' align='center' size=20>Please Login your account first!</p>";
}
else{

?>
  <script>
$(function() {
  $( "#datepicker" ).datepicker({dateFormat : 'yy-mm-dd'});
});
  </script>

<div class="container">

<table cellspacing="50" align="center">
    
	<tr><td><br/><br/></td></tr>
	<tr><td align="center"><p style="font-size: 260%"><b>Search the Reservation</b></p></td></tr>
	<tr>
		<td align="center">
			<br />
			
			<!-- <INPUT TYPE="submit" VALUE="Search"> -->
			<br/><br/>
			<FORM METHOD="POST" ACTION="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="col-lg-10">
                Date: <input type="text" name="given"  id="datepicker">
			</div>
			<!-- <INPUT TYPE="submit" VALUE="Search"> -->
			<div class="col-lg-2">
			<button type="submit" class="btn btn-primary">Search</button>
			</div>
			</FORM>

		
		</td>
	</tr>

<tr>
		<td align="center">
			<br />
<?php 
if (!empty($_POST)){
                include_once('connect.php');
                $Date=$_POST["given"];
                if ($Date!=NULL){



                  
                    $result=mysqli_query($cxn,"Select * from Reservation where DATE(pick_up_time)<='$Date' && '$Date'<=DATE(return_time)");




                    if (mysqli_num_rows($result)===0){echo "<p style='font-size: 130%'><br/><br/>There is no reservation on $Date.<br/><br/></p>";}
                    else{
                       echo "<p style='font-size: 160%'>The reservations on $Date : <br/></p>";
                        echo "      
                        <div align='center'>
                    <table class='rwd-table'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                      <tr>
                        <th>Reservation Number</th>
                        <th>Member ID</th>
                        <th>VIN</th>
                        <th>Location ID</th>
                        <th>Pick Up Time</th>
                        <th>Return Time</th>
                        <th>Status</th>
                      </tr> ";
                     while($row = mysqli_fetch_assoc($result))
                      {
                        extract($row);
                         
                        echo "<tr>
                                <td>$reservation_number</td>
                                <td>$member_ID</td>
                                <td>$VIN</td>
                                <td>$locationID</td>
                                <td>$pick_up_time</td>
                                <td>$return_time</td>
                                <td>$status</td>
                        </tr>";
                     }
                        echo "</table>";
                      }
                    }
                }
            ?>   		
    
    </table>
</div>
<?php
}
	include_once('./includes/footer.class.php');
?>