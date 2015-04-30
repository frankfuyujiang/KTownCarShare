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
	<tr><td align="center"><p style="font-size:200%"><b>Search the Members need to Pay Annual Membership Fee</b></p></td></tr>
	<tr>
		<td align="center">
			<br />
			
			<!-- <INPUT TYPE="submit" VALUE="Search"> -->
			<br/><br/>
			<FORM METHOD="POST" ACTION="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="col-lg-10">
                Date: <input type="text" name="givenDate"  id="datepicker">
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
if (!empty($_POST["givenDate"])){
      $Date=$_POST["givenDate"];   
                include_once('connect.php');
                if ($Date!=NULL){
                    $result=mysqli_query($cxn,"Select Member.member_ID, Name, annual_membership_fee from Member join Fee where month(registration_anniversary_date)=month('$Date') and day(registration_anniversary_date)=day('$Date') and Member.member_ID=Fee.member_ID");

                    if (mysqli_num_rows($result)===0){
                      echo "<p style='font-size: 130%'><br/><br/>There is no person need to pay the annual membership fee on $Date.<br/><br/></p>";}
                   
                else  { 
                    echo "<p style='font-size: 160%'>Those people need pay their annual membership fee on $Date :<br/></p>";
                    echo"
        
                        <div align='center'>
                    <table class='rwd-table'>
                        <col width='200'>
                        <col width='200'>
                        <col width='200'>
                  
                      <tr>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Annual Membership Fee</th>
                      
                      </tr> ";
                    
                    
                  while($row = mysqli_fetch_assoc($result)){
                        extract($row);
                         
                         echo "<tr>
                                <td>$member_ID</td>
                                <td>$Name</td>
                                <td>$annual_membership_fee</td>
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