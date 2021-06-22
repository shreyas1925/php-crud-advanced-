<?php
session_start();

if(!isset($_SESSION['name'])){
  header("location:login.php");
}
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
    * {
      padding: 0px;
      margin: 0px;
      box-sizing: border-box;
    }

    .main-div {
      background-image: url("mernhome.jpg");
      width: 100%;
      height: 100vh;
      background-position: center;
      background-size: cover;
    }
    .heading_1 {
      font-size: 30px;
      padding: 2px;
    }
    .heading_3 {
      font-size: 30px;
      padding: 2px;
    }
    .heading_2 {
      font-style: bold;
      font-size: 80px;
      padding: 2px;
      color: white;
      text-shadow: 4px 2px 5px black;
    }
    .centre-div {
      display: flex;
      align-items: center;
      flex-direction: column;
      justify-content: center;
    }

    .another-div {
      margin-left: -490px;
      margin-top: 370px;
    }
   
    .texts {
      color: white;
      text-transform: uppercase;
      font-size: 27px;
      text-shadow: 2px 1px 3px black;
    }
    .text{
      color: white;
      text-transform: uppercase;
      font-size: 15px;
      text-shadow: 1px 2px 1px black;    }
      </style>
  <body>
    <!-- Navigation -->

    <section>
      <div class="main-div">
        <nav class="navbar navbar-expand-lg ">
          <div>
            <h1 class="texts">Demo Recognition</h1>
          </div>

          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto text-uppercase">
              <li class="nav-item active ">
                <a class="nav-link text" href="index.html"
                  >Home <span class="sr-only"></span
                ></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text" href="message.html">Message</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text" href="login.php">login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text" href="logout.php">LOGOUT</a>
              </li>
            </ul>
          </div>
        </nav>
        <div class="centre-div">
          <div class="another-div">
            <!-- <h2 class="heading_1">Welcome to the <span>HOME</span>PAGE</h2> -->
            <h1 class="heading_2">Hello ,<?php echo  $_SESSION['name'] ; ?></h1>
            <h3 class="heading_3 ml-2">We are Glad to see u back !!</h3>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
