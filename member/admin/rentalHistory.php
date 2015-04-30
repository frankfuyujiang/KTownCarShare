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

	<tr><td align="center"><p style="font-size: 260%"><b>Search the Car</b></p></td></tr>
	<tr>
		<td align="center">
            


			<FORM METHOD="POST" ACTION="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="col-lg-12" align="left">
			<p>VIN:</p>
                <br/><INPUT CLASS="form-control" TYPE="TEXT" NAME = "VinInput" placeholder="VIN" size="20"/>
                <br/>
			</div>
                
			<div>
			<button type="submit" class="btn btn-primary">Search</button>
			</div>
			</FORM>
        </td>
    </tr>
    <tr>
        <td>
            <?php 

                require_once __DIR__ . '/libs/config.php';
$cxn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}
            
                if (!empty($_POST["VinInput"])){
                    $VIN=$_POST["VinInput"];



                    $result=mysqli_query($cxn,"Select * from Reservation where VIN='$VIN'");
                    



                    
                    if (mysqli_num_rows($result) === 0)  {
            echo "<p style='color:red'>This car hasn't any rental history.</p>";
          }     
                    else{
                        echo "<p><b>This car's all rental history: </b></p> <br/><br/>";
              echo "      <div align='center'>
                    <table class='rwd-table'>
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
                            </tr>";
                      }
                        echo "</table>";
                }
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