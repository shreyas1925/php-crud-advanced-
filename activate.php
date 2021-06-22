<?php

session_start();

include "connection.php";

$token=$_GET['token'];

$updatequery="update regis set status='active' where token='$token' ";

$query=mysqli_query($con,$updatequery);

if($query){

    if(isset($_SESSION['msg'])){
        $_SESSION['msg']="Your Account Verification is succesfull";
        header("location:login.php");

    }else{
        $_SESSION['msg']="You are logged out.Please login to continue";
        header("location:login.php");
    }
   
}else{
    $_SESSION['msg']="Your Account Verification Failed";
    header("location:regis.php");
}








?>