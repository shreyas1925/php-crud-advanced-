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

  
  $email=mysqli_real_escape_string($con,$_POST['email']);

  $emailquery="select * from regis where email='$email'";

  $query=mysqli_query($con,$emailquery);

  $emailcount=mysqli_num_rows($query);

  if($emailcount){

    $userdata=mysqli_fetch_array($query);

    $name=$userdata['name'];

    $token=$userdata['token'];

    
    $to_email=$email;
    $subjct="Password Reset!";
    $body="Heyy,  $name Click here to reset your password !
    http://localhost/php_with_mysql/php_advance/reset_password.php?token=$token ";
    $headers="From : shreyasshettigar34@gmail.com";

    

    if(mail($to_email,$subjct,$body,$headers)){
      $_SESSION['msg']="Check your mail to reset your Password $email";
      header("location:login.php");
    }else{
        echo "not ok bro";
    }




  }else{
?>
<script>
alert("No Email Found");
</script>
<?php
  }

}
   
  




?>
    <section>
      <div class="container">
        <h1
          class="text-center text-capitalize font-weight-bold pt-5 text-primary"
        >
          Recover your Account
        </h1>
        <hr class="w-50 mx-auto pb-5" />

        <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="POST" id="formy" class="mx-auto my-5">
          
          <div class="form-group">
            <label for="email">Email address:</label>
            <input
              type="email"
              class="form-control"
              placeholder="Enter email"
              id="email"
              name="email"
              autocomplete="off"
              required
            />
          </div>
          
          <div class="form-group ml-2 ">
            <p>Don't have an account ? <a href="regis.php" class="ml-2">Sign Up</a></p>
          </div>
          <button type="submit" name="submit" class="btn btn-outline-success w-50">
            Send Mail
          </button>
        </form>
      </div>
    </section>

  </body>
</html>


