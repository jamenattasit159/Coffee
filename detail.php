<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>complete responsive coffee shop website design tutorial</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style1.css">

</head>

<body>

   <!-- header section starts     -->

   <header class="header fixed-top">

      <div class="container">

         <div class="row align-items-center">

            <a href="main_in.php" class="logo mr-auto"> <i class="fas fa-mug-hot"></i> coffee </a>

            <nav class="nav">
               <a href="#home">home</a>
               <!-- <a href="#about">about</a> -->
               <a href="#beans">Beans</a>
               <a href="#coffee">Coffee</a>
               <!-- <a href="#gallery">gallery</a> -->
               <!-- <a href="#reviews">reviews</a> -->
               <a href="#contact">contact</a>
               <a href="login.php" class="fas fa-user-circle"></a>
            </nav>
         </div>

      </div>

   </header>
   <section class="home" id="home">

      <div class="container">

         <div class="row align-items-center text-center text-md-left min-vh-100">
            <div class="col-md-6">
               
               <h3>Detail Bean Coffee</h3>
               <!-- <a href="login-form" class="link-btn">get started</a> -->
            </div>
         </div>

      </div>

<?php

   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "coffeemenu";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
      die("connection failed" . $conn->connect_error);
   }
   /* echo "<a class = 'badge bg-info' >Connection Complete</a>"; */
   $sql = "SELECT  * FROM bansmenu where id='$_GET[id]'";
   
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {


      while ($row = $result->fetch_assoc()) {
         echo "<center>
            <div class='container2'>
            <section class='blogs'>
            <div class='box-container container'>
            <div class='box'>
            <div class='image'>
               <img width='50px' src='./uploads/" . $row["img"] . "' class='rounded' alt=''>
            </div>
            <div class='content'>
            <h1>" . $row["fname"] . "</h1>
               <h3>" . $row["details"] . "</h3>
               
               
               
            </div>
            
         </div>
      </div>
   </section>
   </div>";
      }
   } else {
      echo "0 results";
   }


   $conn->close();


   ?>