

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

a{
    text-decoration: none;
    color: #4A4A4A !important;
}

a:hover{
    text-decoration: underline;
    color: #6B6B6B !important ;
}

.container{
    background-color:RGBA(79, 213, 214,0.8);
    border: 1px solid #ddd;
    display: center;
    width: 630;
}

</style>
<br>
<?php
include_once('connect.php');
$result=mysqli_query($cxn,"SELECT * from car");
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
Select A car to book:<br>

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












