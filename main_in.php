<?php

require_once "connectmenu.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coffee review website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
       <header class="header fixed-top">
        <div class="container">
            <div class="row align-items-center">
                <a href="main_in.php" class="logo mr-auto"> <i class="fas fa-mug-hot"></i> coffee </a>
                <nav class="nav">
                    <a href="#home">home</a>
                    <a href="#menu">Beans</a>
                    <a href="#coffee">Coffee</a>
                    <a href="#contact">contact</a>
                </nav>
                <a href="logout.php" class="btn btn-danger">logout</a>
            </div>

        </div>

    </header>


    <section class="home" id="home">

        <div class="container">

            <div class="row align-items-center text-center text-md-left min-vh-100">
                <div class="col-md-6">
                    <span>C-OUT coffee</span>
                    <h3>Coffee for you</h3>
                </div>
            </div>

        </div>

    </section>
    <br>
    <br>
    <br>
    <br>
    <h1 class="heading"> Bens Coffee </h1>
    
    
    
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
    $sql = "SELECT  * FROM bansmenu";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {


        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='container2'>
            <section class='blogs'>
            <div class='box-container container'>

            <div class='box'>
            <div class='image'>
               <img width='200px' src='./uploads/" . $row["img"] . "' class='rounded' alt=''>
            </div>
            <div class='content'>
               <h3>" . $row["fname"] . "</h3>
               <p>" . $row["description"] . "</p>
               
               <a class='link-btn' href='detail.php?id=$row[id]'>read more</a>
            </div>
            <div class='icons'>
               <span> <i class='fas fa-calendar'></i> Create </span>
               <span> <i class='fas fa-user'></i> by admin </span>
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
<h1 class="heading"> our daily posts </h1>
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
    $sql = "SELECT  * FROM ingredient";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {


        while ($row = $result->fetch_assoc()) {
            echo "
            
            <div class='container2'>
            <section class='blogs'>
            <div class='box-container container'>

            <div class='box'>
            <div class='image'>
               <img width='200px' src='./uploads/" . $row["img"] . "' class='rounded' alt=''>
            </div>
            <div class='content'>
               <h3>" . $row["ingname"] . "</h3>
               
               <a class='link-btn' href='detailing.php?id=$row[iding]'>coffee recipe</a>
            </div>
            <div class='icons'>
               <span> <i class='fas fa-calendar'></i> Create </span>
               <span> <i class='fas fa-user'></i> by admin </span>
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





    <section class="contact" id="contact">

        <h1 class="heading"> contact us </h1>

        <div class="container">

            <div class="contact-info-container">

                <div class="box">
               <i class="fas fa-phone"></i>
               <h3>phone</h3>
               <p>063-9503-701</p>
               <p>066-109-2796</p>
            </div>

            <div class="box">
               <i class="fas fa-envelope"></i>
               <h3>email</h3>
               <p>nattasitkung.am@gmail.com</p>
               <p>rutloop@gmail.com</p>
            </div>

            <div class="box">
               <i class="fas fa-map"></i>
               <h3>address</h3>
               <p>Khlong Hok, Pathum Thani, Thailand</p>
            </div>

        </div>

    </section>

    <section class="footer container">

        <a href="#" class="logo"> <i class="fas fa-mug-hot"></i> coffee </a>

        <p class="credit"> created by <span>mr.Nattasit and Thanawin</span> | everything is easy </p>

        <div class="share">
        <a href="https://www.facebook.com/Jame.Nattasit.4508/" class="fab fa-facebook-f"></a>
         <a href="#" class="fab fa-linkedin"></a>
         <a href="#" class="fab fa-twitter"></a>
         <a href="https://github.com/jamenattasit159" class="fab fa-github"></a>
        </div>

    </section>

    <script src="js/script.js"></script>

</body>

</html>