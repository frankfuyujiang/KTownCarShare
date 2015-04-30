<?php
include('./includes/header.class.php');
?>


<!-- Header and Nav -->
<?php	
require('./includes/nav.class.php');
?>

  <script>
  function selectVIN() {
    var table = document.getElementById("tableId");
    var rows = table.getElementsByTagName("tr");
    for (i = 0; i < rows.length; i++) {
        var currentRow = table.rows[i].getElementsByTagName('a')[0];
        var createClickHandler = 
            function(row) 
            {
                return function() { 
                                        var cell = row.getElementsByTagName("td")[0];
                                        var id = cell.innerHTML;
                                        var bookform=document.getElementsbyTagName("Form")[0];
                                        bookform.vin.value=id;
                                        bookform.submit();
                                        //alert("id:" + id);
                                 };
            };

        currentRow.onclick = createClickHandler(currentRow);
    }
}
window.onload=addRowHandlers();
$(function() {
  $( "#datepicker" ).datepicker({dateFormat : 'yy-mm-dd'});
});
  </script>
<?php
    $Date='$given';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $Date=test_input($_POST["given"]);    
            }
    function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
?>
<div class="container">

<table cellspacing="50" align="center">
    
	<tr><td><br/><br/></td></tr>
    <FORM METHOD="POST" ACTION="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Date: <input type="text" name="given"  id="datepicker">
	<tr><td align="center"><p><b>Search the Available Cars</b></p></td></tr>
	<tr>
		<td align="center">
			<br />
			
			<!-- <INPUT TYPE="submit" VALUE="Search"> -->
			<br/><br/>
			
			<div class="col-lg-10">
                    Location: <input type="text" name="location"  id="datepicker">
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
        $inputLocationID=$_POST["location"];
                if ($Date!=NULL){
                    $result=mysqli_query($cxn,"Select car.VIN,make,model,year from car where car.locationID='$inputLocationID' AND Car.VIN not in (Select distinct VIN from Reservation where date(pick_up_time)<='$Date' and date(return_time)>= '$Date')");
                    if (mysqli_num_rows($result)===0){echo "There is no available car on $Date.";}
                    else{
                        echo "The available cars on $Date : <br/>";
                     while($row = mysqli_fetch_assoc($result))
                      {
                        extract($row);
                         
                        echo "$VIN,$make,$model,$year<br />";
                     }
                      }
                    }
                }
            ?>   		
    
    </table>
</div>
<?php
	include_once('./includes/footer.class.php');
?>