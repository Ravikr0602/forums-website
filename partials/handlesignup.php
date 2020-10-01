<?php

$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
include '_dbconnect.php';
$user_name = $_POST['signupusername'];
$user_email = $_POST['signupEmail'];
$pass = $_POST['signupPassword'];
$cpass = $_POST['signupcpassword'];

// check wether this email exits
$exitSql =" select * from `users` where user_email = '$user_email'";
$result = mysqli_query($conn, $exitSql);
$numRows = mysqli_num_rows($result);
if($numRows>0){
    $showError ="Email is already present";
    //header("Location: /forums/index.php?existed=true");
}
else
{
    if($pass == $cpass){
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql ="INSERT INTO `users` (`user_name`,`user_email`, `user_pass`, `timestamp`) VALUES ( '$user_name','$user_email', '$hash', CURRENT_TIMESTAMP())";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert = true;
            header("Location: /forums/index.php?signupsuccess=true");
            exit();
        }
    }
    
else{
    header("Location: /forums/index.php?signupsuccess=false");
    //$showError = "Password do not match please enter same password.";
   
}
}
header("Location: /forums/index.php?existed=true");
//header("Location: /forums/index.php?signupsuccess=false&error=$showError");
}

?>