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
<style type="text/css">
.wrap {
    display:inline-block;
    width:200px;
    height:300px;
    margin:20px;
    padding:20px;
    border:1px solid #c2c0b8;
    background-color:#fff;
    -webkit-box-shadow:0 0 60px 10px rgba(0, 0, 0, .1) inset, 0 5px 0 -4px #fff, 0 5px 0 -3px #c2c0b8, 0 11px 0 -8px #fff, 0 11px 0 -7px #c2c0b8, 0 17px 0 -12px #fff, 0 17px 0 -11px #c2c0b8;
    -moz-box-shadow:0 0 60px 10px rgba(0, 0, 0, .1) inset, 0 5px 0 -4px #fff, 0 5px 0 -3px #c2c0b8, 0 11px 0 -8px #fff, 0 11px 0 -7px #c2c0b8, 0 17px 0 -12px #fff, 0 17px 0 -11px #c2c0b8;
    box-shadow:0 0 60px 10px rgba(0, 0, 0, .1) inset, 0 5px 0 -4px #fff, 0 5px 0 -3px #c2c0b8, 0 11px 0 -8px #fff, 0 11px 0 -7px #c2c0b8, 0 17px 0 -12px #fff, 0 17px 0 -11px #c2c0b8;
}
.wrap img {
    width: 100%;
    height:fill;
    margin-top: 15px;
}
.wrap div {
    height: 25px;
}
.wrap h4 {
    color:#028482;
}


h2{
    font-size: 20px;
    font-weight: bold;
    margin-top: 5px; 
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
}


.container{
    border: 1px solid #ddd;
    display: center;
    width:100%;
    background-image:url("./Luxury-Cars-10.jpg");
}

</style>
</head>
<!-- Header and Nav -->
<?php	
require('./includes/nav.class.php');
?>




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

<?php
if (empty($_SESSION['member_ID'])){
  echo "<p style='color:red' align='center' size=20>Please Login your account first!</p>";
}
else{

?>
        <div class="container">
        <br><br>
        <FORM METHOD="POST" ACTION="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div align="center">
      <div style="display:inline-block">
                <span style="color:white">From: </span><input type="text" name="start"  id="datetimepicker">
                <br/><br/>
			</div>
      <div style="display:inline-block">
                &nbsp;&nbsp;<span style="color:white">To:</span>&nbsp;&nbsp;
                <input type="text" name="end"  id="enddatetimepicker">
                                <br/><br/>
      </div>
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
            <div align="center">
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
			<div align="center">
			<button type="submit" class="btn btn-primary">Search</button>
			</div>
      <br>
			</FORM>
      </div>



<?php 
if (!empty($_POST['location'])&&!empty($_POST['start'])&&!empty($_POST['end'])){
    $locationNames = mysqli_query($cxn, "Select locationName from location where locationID=$location");
    while($row=mysqli_fetch_assoc($locationNames)){
      extract($row);

      echo "<br/><br/><p style='font-size:160%'><b>Selected Date is from $DateStart to $DateEnd at $locationName : </b></p>";}
    $timeStart = strtotime($DateStart);
    $Start = date('Y-m-d H:i:s',$timeStart);
    $timeEnd = strtotime($DateEnd);
    $End = date('Y-m-d H:i:s',$timeEnd);
    //$_GET['Start']=date('Y-m-d H:i:s',$time);
    
    
//                if ($Date!=NULL){
$result=mysqli_query($cxn,"Select car.VIN,make,model,year from car where car.locationID='$location' AND Car.VIN not in (Select distinct VIN from Reservation where ('$Start' between pick_up_time and return_time) or ('$End' between pick_up_time and return_time) or (pick_up_time between '$Start' and '$End') or (return_time between '$Start' and '$End'))");
if (mysqli_num_rows($result)===0){echo "<br/><br/><p style='font-size: 120%'>Sorry. There is no available car for between the selected dates. Please try other dates.</p>";}
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
<FORM METHOD="POST" ACTION="makeReservation.php"> 
<p style='font-size:160%'>The Following Cars are Available.</p>
<p style='font-size:160%'>Select a car to book: <br/></p>
<?php

echo "<Input type='hidden' name='starttime' value=$timeStart>";
echo "<Input type='hidden' name='endtime' value=$timeEnd>";
echo "<Input type='hidden' name='locationID' value=$location>";

?>
<select name="VIN">

    <option value="">Select...</option>
<?php 
    for($i=1;$i<sizeof($vinlist);$i++){
        $vin=$vinlist[$i];
        echo "<option value=$vin>Listing $i</option>";
    }
?>
</select>
<br/><br/><br/>
<button type="submit" class="btn btn-primary">Book Now</button>
</FORM>
</div>

<?php
}
}
}
include_once('./includes/footer.class.php');
?>