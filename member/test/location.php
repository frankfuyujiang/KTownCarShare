<?php
include('./includes/header.class.php');
?>

<head>
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.common.min.css">
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.rtl.min.css">
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.default.min.css">
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.dataviz.min.css">
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.dataviz.default.min.css">
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.mobile.all.min.css">

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://cdn.kendostatic.com/2015.1.318/js/kendo.all.min.js"></script>
<script src="http://cdn.kendostatic.com/2015.1.318/js/angular.min.js"></script>
<script src="http://cdn.kendostatic.com/2015.1.318/js/jszip.min.js"></script>
    
</head>
<!-- Header and Nav -->
<?php	
require('./includes/nav.class.php');
?>


<div class="container">


<!--
<form name="myForm" action="createevent.php" onsubmit="return validateForm()" method="get"> 
<p>Date<input type="text" name="mydate" id="datetimepicker" /></p>
<p>Location 
<Select name="location">
    <option value="1">Princess Street</option>
    <option value="2">Cataraqui Center</option>
</Select>


<input type="submit" name="submit" value="Submit" />

</form>
-->



<?php
    include_once('connect.php');
    $DateStart='$start';
    $DateEnd='$end';
    $location='$location';

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $DateStart=test_input($_POST["start"]);
        $DateEnd=test_input($_POST["end"]);  
        $location= test_input($_POST["location"]);
        
            }
    function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
?>
        
        <FORM METHOD="POST" ACTION="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="col-lg-10">
                From: <input type="text" name="start"  id="datetimepicker">
                <br/><br/>
			</div>
            <div class="col-lg-10">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="end"  id="enddatetimepicker">
                                <br/><br/>

            </div>
            <script>
            $("#datetimepicker").kendoDateTimePicker({
                format: "yyyy-MM-dd hh:mm tt"
            });
            </script>
            
            <script>
            $("#enddatetimepicker").kendoDateTimePicker({
                format: "yyyy-MM-dd hh:mm tt"
            });
            </script>
            <div >
            <?php
                $locations= mysqli_query($cxn, "Select locationID, locationName, address from Location order by locationID ");
                echo "<select name='location'> <option value=''>Locations</option>";
                while($row = mysqli_fetch_assoc($locations)){
                    extract($row);
                         
                    echo "<option value=$locationID>$locationName : $address</option>";
                 }

                echo "</select>";                
                ?>
                <br/><br/>
            </div>

			<!-- <INPUT TYPE="submit" VALUE="Search"> -->
			<div class="col-lg-2">
			<button type="submit" class="btn btn-primary">Search</button>
			</div>
			</FORM>

<?php 
if (!empty($_POST['location']&&!empty($_POST['start'])&&!empty($_POST['end']))){


    //echo "<p>Selected Date is from $DateStart to $DateEnd</p>";
    $time = strtotime($DateStart);
    $Start = date('Y-m-d H:i:s',$time);
    $timeB = strtotime($DateEnd);
    $End = date('Y-m-d H:i:s',$timeB);
    //$_GET['Start']=date('Y-m-d H:i:s',$time);
    

  //  echo "$location  location";
//echo "<p>new from $Start to $End<br/></p>";
    
//                if ($Date!=NULL){
$result=mysqli_query($cxn,"Select car.VIN,make,model,year from car where car.locationID='$location' AND Car.VIN not in (Select distinct VIN from Reservation where ('$Start' between pick_up_time and return_time) or ('$End' between pick_up_time and return_time))");
if (mysqli_num_rows($result)===0){echo "<p>There is no available car from $DateStart to $DateEnd.</p>";}
else{
$counter = 1;
$vinlist=array();
$vinlist[0]="";
while($row=mysqli_fetch_assoc($result)){
    extract($row);
    $vinlist[$counter]=$VIN;
    echo "<div class='wrap'>
    <div align='left' ><p>List $counter</p></div>
    <div align='left'><h4>Make: $make</div>
    <div align='left'><h4>Model: $model</div>
    <div align='left'><h4>Year: $year</div>
    <div align='center'><img src=''></div> 
    </div>";
    $counter++;
}

?>
<br>
<br>
<div align="center">
<FORM METHOD="POST" ACTION="successbook.php"> 
The Following Cars are Available.
Select A car to book:<br>
<Input type="hidden" name="starttime" value='$Start'>
<Input type="hidden" name="endtime" value='$End'>
<Input type="hidden" name="locationID" value='$location'>
<select name="VIN">
    <option value="">Select...</option>
<?php 
    for($i=1;$i<sizeof($vinlist);$i++){
        $vin=$vinlist[$i];
        echo "<option value=$vin>Listing $i</option>";
    }
?>
</select>
<Input type="button" class="btn btn-primary" value="BOOK NOW">
</FORM>
</div>

<?php

/*}

echo "<p><br/>The following cars are available on from $DateStart to $DateEnd : <br/><br/</p>";
echo "<form  method='post'    action='makeReservation.php' >";
echo "<select name='cars'> <option value=''>Available Cars</option>";
while($row = mysqli_fetch_assoc($result)){
    extract($row);
    echo "<option value=$VIN>Make: $make; Model: $model; Year: $year<br />";
}
echo "<tr><td>";       
echo "<button type='submit'>Reserve</button>";
echo "</form></td></tr>";
            ?>   		
</div>*/


	include_once('./includes/footer.class.php');
?>