<?php
include_once('./includes/header.class.php');
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
	include_once('./includes/nav.class.php');
?>

<div class="container">
<table cellspacing="50" align="center">

	<tr><td align="center"><p style="font-size: 260%"><b>Cars Need Maintanence </b></p></td></tr>
	<tr>
		<td align="center">
     
    <tr>
        <td>
            <?php 
               require_once __DIR__ . '/libs/config.php';
$cxn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}

                $result=mysqli_query($cxn,"Select * from Car where last_odometer_reading-odometer_reading_of_last_maintenance_check>=5000");




                
                if ($result==NULL){
                    echo "<div align='center'><br/><br/><br/><br/>There are no cars need maintenance.<br/><br/><br/><br/><br/><br/><br/><br/></div>";
                }
                else{
                    
                    echo "<p><b>The following car(s) need maintenance: </b></p> <br/><br/>";
              echo "      <div align='center'>
                    <table class='rwd-table'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>

                    <tr>
                        <th>VIN</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Last Odometer Reading</th>
                        <th>Odometer Reading of Last Maintenance Check</th>
                        <th>Date of Last Maintenance Check</th>

                      </tr> ";
                    
                    while($row = mysqli_fetch_assoc($result)){
                        extract($row);
                        echo "<tr>
                                <td>$VIN</td>
                                <td>$make</td>
                                <td>$model</td>
                                <td>$year</td>
                                <td>$last_odometer_reading</td>
                                <td>$odometer_reading_of_last_maintenance_check</td>
                                <td>$date_of_last_maintenance_check</td>
                        </tr>";
                       }
                    echo "</table>";
                }
            ?>   			
<!--
			<FORM METHOD="POST" ACTION=".php">
			

			</FORM>
-->
		</td>
	</tr>
</table>
</div>


<?php
	include_once('./includes/footer.class.php');
?>