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
    <section>
      <div class="container">
        <h1
          class="text-center text-capitalize font-weight-bold pt-5 text-primary"
        >
          Registration Form
        </h1>
        <hr class="w-50 mx-auto pb-5" />

        <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="POST" id="formy" class="mx-auto my-5">
          <div class="form-group">
            <label for="email">Name:</label>
            <input
              type="text"
              class="form-control"
              placeholder="Enter Your Name"
              id="email"
              name="name"
              autocomplete="off"
              required
            />
          </div>
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
          <div class="form-group">
            <label for="pwd">Mobile number:</label>
            <input
              type="number"
              class="form-control"
              placeholder="Enter password"
              id="pwd"
              name="phone"
              autocomplete="off"
              required
            />
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input
              type="password"
              class="form-control"
              placeholder="Enter password"
              id="pwd"
              name="password"
              autocomplete="off"
              required
            />
          </div>
          <div class="form-group">
            <label for="pwd">Confirm Password:</label>
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
          <button type="submit" name="submit" class="btn btn-outline-success w-25">
            Register
          </button>
        </form>
      </div>
    </section>

  </body>
</html>


<?php

include "connection.php";



if(isset($_POST['submit'])){

  // mysqli_real_escape_string For Extra level of security

  $name=mysqli_real_escape_string($con,$_POST['name']); 
  $email=mysqli_real_escape_string($con,$_POST['email']);
  $phone=mysqli_real_escape_string($con,$_POST['phone']);
  $password=mysqli_real_escape_string($con,$_POST['password']);
  $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);

  $pass=password_hash($password,PASSWORD_BCRYPT);
  $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

  // To generate a random number
  $token=bin2hex(random_bytes(15));

  // Check whether email previously exist or not 

  $emailquery="select * from regis where email='$email'";

  $query=mysqli_query($con,$emailquery);

  $emailcount=mysqli_num_rows($query);

  if($emailcount>0){
    ?>
    <script>
      alert("Email Already Exist");
    </script>
    <?php
  }else{
    if($password===$cpassword){
      $insertquery="insert into regis(name,email,phone,password,cpassword,token,status) values('$name','$email','$phone','$pass','$cpass','$token','inactive')";
      $inputquery=mysqli_query($con,$insertquery);

      if($inputquery){
        
          $to_email=$email;
          $subjct="Email Activation !";
          $body="Heyy,  $name Click here to activate your account
          http://localhost/php_with_mysql/php_advance/activate.php?token=$token ";
          $headers="From : shreyasshettigar34@gmail.com";

          $bro=mail($to_email,$subjct,$body,$headers);

          if($bro){
            $_SESSION['msg']="Check your mail to activate your Account $email";
            header("location:login.php");
          }else{
              echo "ok";
          }




      }else{
        ?>
        <script>
          alert("Registration Failed !!");
        </script>
        <?php
      }


    }else{
      ?>
      <script>
        alert("Password is not matching");
      </script>
      <?php
    }
  }





}



?>