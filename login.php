<?php
session_start();
// To properly handle the buffer
ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

.forget{
      margin-top:-340px;
      margin-left:360px;
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
        $email=$_POST['email'];
        $password=$_POST['password'];
        $email_search="select * from regis where email='$email' and status='active'";
        $query=mysqli_query($con,$email_search);
        $email_count=mysqli_num_rows($query);

        if($email_count){

            $email_password=mysqli_fetch_assoc($query);

            $db_password=$email_password['password'];

            $_SESSION['name']= $email_password['name'];

            // In built function to check the verfication of db paswword and our plain text password
            
            $pass_decode=password_verify($password,$db_password);

            if($pass_decode){
                
                 if(isset($_POST['rememberme'])) {

                  setcookie("emailcookie",$email,time()+86400);
                  setcookie("passwordcookie",$password,time()+86400);

                   ?>
                   <script>
                      alert("Login Successfull !!");
                      location.replace("home.php");
                   </script>
                   <?php
                 } else{
                   ?>
                  <script>
                      alert("Login Successfull !!");
                      location.replace("home.php");
                  </script>
                  <?php
                 }
                   

                
            }else{
                ?>
                <script>
                    alert("Invalid Credentials !!");
                </script>
                <?php
            }
        
        }else{
            ?>
            <script>
              alert("Invalid Credentials !!");
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
          Login Form
        </h1>
     
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="POST" id="formy" class="mx-auto my-5">
        <hr class="w-50 mx-auto pb-5" />
        <div class="bg-success text-white  p-2 w-100 mb-5">

        <?php 
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
          }else{
            echo $_SESSION['msg']="You are logged out. Please login Again";
          }     
        ?>

        
        </div>
          <div class="form-group">
            <label for="email">Email address:</label>
            <input
              type="email"
              class="form-control"
              placeholder="Enter email"
              id="email"
              value="<?php if(isset($_COOKIE['emailcookie'])) {
                echo $_COOKIE['emailcookie'];}  ?>"
              name="email"
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
              value="<?php if(isset($_COOKIE['passwordcookie'])) {
                echo $_COOKIE['passwordcookie'];}  ?>"
              name="password"
              autocomplete="off"
              required
            />
          </div>
          <div class="form-group">
            <!-- <label for="pwd">Password:</label> -->
            <input
              type="checkbox"
              class="mr-2"
              id="pwd"
              name="rememberme"
              value="Remember Me"
              autocomplete="off"
              
            /> Remember Me

            
          </div>

         
         
          <div class="form-group ml-2 ">
            <p>Don't have an account? <a href="regis.php" class="ml-1">Sign Up</a></p>
            <p>Forgot your Password? <a href="recover_email.php" class="ml-1">Click Here</a></p>
            

          </div>
          <button type="submit" name="submit" class="btn btn-outline-success w-50">
            Login 
          </button>
        </form>
      </div>
    </section>
</body>
</html>


