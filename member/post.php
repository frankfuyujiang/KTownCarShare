<?php 
    if(isset($_POST['reservPost']) AND $_POST['reservPost']) { 
        // Check Reservation Func.

        $result = searchReservation($cxn, $_POST['reservID']);
        

    }




?>