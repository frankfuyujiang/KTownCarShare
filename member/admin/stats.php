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

	<tr><td align="center"><p style="font-size: 160%"><b>The Car with Highest Number of Rentals</b></p></td></tr>
    
        <tr>
        <td>
            <?php 
                 $host = "localhost";
                 $user = "jenny1994";
                 $password = "815815";
                 $database = "KTCS";

                 $cxn = mysqli_connect($host,$user,$password, $database);
                 // Check connection
                 if (mysqli_connect_errno())
                  {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }

              
                    $result=mysqli_query($cxn,"Select * 
                    from (   
                        Select Car.VIN, make,model,year, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_num
                        From Car Left join Reservation 
                        on Car.VIN=Reservation.VIN
                        group by VIN) as T
                    where rental_num =
                    (Select max(rental_num)
                    From(   
                        Select Car.VIN, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_num
                        From Car Left join Reservation 
                        on Car.VIN=Reservation.VIN
                        group by VIN) as K)
                        ");
                    
                     echo "      <div align='center'>
                    <table class='rwd-table'>
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
                        <th>Rental Number</th>
                        

                      </tr> ";

                     while($row = mysqli_fetch_assoc($result))
                      {
                        extract($row);
                        echo "<tr>
                                <td>$VIN</td>
                                <td>$make</td>
                                <td>$model</td>
                                <td>$year</td>
                                <td>$rental_num</td>
                        
                        </tr>";
                
                      }
                echo "</table>";
                
            ?>   			

		</td>
	</tr>
    
    <tr><td align="center"><p style="font-size: 160%"><b>The Car with Lowest Number of Rentals</b></p></td></tr>
	
    <tr>
        <td>
            <?php 
                require_once __DIR__ . '/libs/config.php';
$cxn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}

                    $result=mysqli_query($cxn,"Select * 
from (   
    Select Car.VIN, make,model,year, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_num
	From Car Left join Reservation 
	on Car.VIN=Reservation.VIN
	group by VIN) as T
where rental_num =
(Select min(rental_num)
From(   
    Select Car.VIN, sum(CASE WHEN reservation_number is NULL then 0 ELSE 1 END) as rental_num
	From Car Left join Reservation 
	on Car.VIN=Reservation.VIN
	group by VIN) as K)
    ");
                      echo "      <div align='center'>
                    <table class='rwd-table'>
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
                        <th>Rental Number</th>
                        

                      </tr> ";

                     while($row = mysqli_fetch_assoc($result))
                      {
                        extract($row);
                        echo "<tr>
                                <td>$VIN</td>
                                <td>$make</td>
                                <td>$model</td>
                                <td>$year</td>
                                <td>$rental_num</td>
                        
                        </tr>";
                
                      }
                echo "</table>";
                
            ?>   			

		</td>
	</tr>
</table>
</div>


<?php
	include_once('./includes/footer.class.php');
?>