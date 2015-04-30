<?php

include_once'connect.php';
$error=null;
if (empty($_SESSION['username'])){
if (!empty($_POST['adminIDinput'])&&!empty($_POST['password']))
{
   //get form data
   $adminID = addslashes(strip_tags($_POST['adminIDinput']));
   $password = addslashes(strip_tags($_POST['password']));
   
   if (!$adminID||!$password)
      $error=0;
   else
   {
    //log in
    $login = mysqli_query($cxn,"SELECT * FROM Admin WHERE adminID='$adminID'");
    if (mysqli_num_rows($login)===0)
       $error=1;
    else
    {
      while ($login_row = mysqli_fetch_assoc($login))
      {
  
       //get database password
       $password_db = $login_row['password'];
  
       //encrypt form password
       $password = $password;
       
       //check password
       if ($password!=$password_db)
          $error=2;
       else
       {
          $_SESSION['username']=$login_row['Name']; //assign session
          $_SESSION['adminID']=$login_row['adminID'];
          }
       }
  
  
      }
    }
  }
}
if (isset($_SESSION['username']))
  {
   echo "<div>Hi, ".$_SESSION['username']." You are logged in. <a href='logout.php'>(Log out)</a> &nbsp; </div>";
  }
  else
  {
   echo "

   <form style='margin:0;padding:0' action='index.php' method='POST' >
   <p style='display=inline'>adminID:
   <input style='display:inline' type='text' name='adminIDinput'>
   Password:
   <input type='password' name='password'>
   <input style='display=inline' type='submit' value='Log in'></p>
   </form>
   ";
   if ($error===0){
    echo "<p style='color:red'>Enter a adminID and a Password</p>";
   }elseif ($error===1){
    echo "<p style='color:red'>No Such User Exist</p>";
   }elseif($error===2){
    echo "<p style='color:red'>You have entered the wrong Password</p>";
   }else{
    echo "";
   }
}



?>