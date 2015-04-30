<?php

function addReservation() {
	$sql = "";
	$result = mysqli_query($cxn, $sql)or die ("<br />Couldn't execute query.");
		
	return $result;
}

function editReservation(){
	$sql = "";
	$result = mysqli_query($cxn, $sql)or die ("<br />Couldn't execute query.");
	
	return $result;
}

function deleteReservation(){
	$sql = "";
	$result = mysqli_query($cxn, $sql)or die ("<br />Couldn't execute query.");
	
	return $result;
}

function searchReservation($cxn, $id){
	$sql = "SELECT * FROM Reservation WHERE reservation_number = '$id'";
	$result = mysqli_query($cxn, $sql)or die ("<br />Couldn't execute query.");
	
	return $result;
}

?>