<?php 

session_start();
require_once "connectmenu.php";

if (isset($_POST['submit'])) {
    $ingname = $_POST['ingname'];
    $ingdetail = $_POST['ingdetail'];
    $img = $_FILES['img'];

    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode('.', $img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
    $filePath = 'uploads/'.$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                if (move_uploaded_file($img['tmp_name'], $filePath)) {
                    $sql = $conn->prepare("INSERT INTO ingredient(ingname, ingdetail, img) VALUES(:ingname, :ingdetail , :img)");
                    $sql->bindParam(":ingname", $ingname);
                    $sql->bindParam(":ingdetail", $ingdetail);
                    $sql->bindParam(":img", $fileNew);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Data has been inserted successfully";
                        header("location: admining.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: admining.php");
                    }
                }
            }
        }
}


?>