<!-- Always should be at the top. As we are using SERVER in action tag so we are using it .
 SERVER SELF in action refernce survives us from self exploitation of PHP while we are coding all in the same page .. -->

<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
   
    <?php include "links/links.php"; ?>
  
  </head>

  <style>
    body {
      padding: 0px;
      margin: 0px;
      box-sizing: border-box;
      font-family: 'Mulish', sans-serif;
    }

    #formy {
      width: 50%;
    }

    @media screen and (max-width: 500px) {
      body {
        /* background-color: lightblue; */
      }
      #formy {
        width: 75%;
      }
    }
  </style>
  <body>
  <?php

include "connection.php";


if(isset($_POST['submit'])){

  // mysqli_real_escape_string For Extra level of security

  if(isset($_GET['token'])){

   
  $token=$_GET['token'];
  $newpassword=mysqli_real_escape_string($con,$_POST['password']);
  $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);

  $pass=password_hash($password,PASSWORD_BCRYPT);
  $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

   

if($newpassword===$cpassword){
       $updatequery="update regis set password='$pass' where token='$token'";

       $iquery=mysqli_query($con,$updatequery);

       if($iquery){
        $_SESSION['msg']="Your Password has been updated Successfully !!";
        header('location:login.php');


      }else{
        $_SESSION['passmsg']="Sorry !! Password has not been updated !!";
        header("location:reset_password.php");
      }


    }else{
            $_SESSION['passmsg']="Sorry !! Passwords are not matching !!";
              
        }
  }else{
    echo "No token found";

  }
}

?>
    <section>
      <div class="container">
        <h1
          class="text-center text-capitalize font-weight-bold pt-5 text-primary"
        >
         Reset Your Password
        </h1>
        <hr class="w-50 mx-auto pb-5" />

        <form action="" method="POST" id="formy" class="mx-auto my-5">
        <div class="bg-danger w-100 p-3 text-white">
        <?php 
         if(isset($_SESSION['passmsg'])){
          echo $_SESSION['passmsg'];

         }else{
             echo $_SESSION="";
         }
        ?>
        </div>

          <div class="form-group mb-3">
            <label for="pwd"></label>
            <input
              type="password"
              class="form-control"
              placeholder="New password"
              id="pwd"
              name="password"
              autocomplete="off"
              required
            />
          </div>
          <div class="form-group">
           
            <input
              type="password"
              class="form-control"
              placeholder="Confirm password"
              id="pwd"
              name="cpassword"
              autocomplete="off"
              required
            />
          </div>
          <div class="form-group ml-2 ">
            <p>Already have an account ? <a href="login.php" class="ml-2">Log in</a></p>
          </div>
          <button type="submit" name="submit" class="btn btn-outline-success w-50">
            Update Password
          </button>
        </form>
      </div>
    </section>

  </body>
</html>


