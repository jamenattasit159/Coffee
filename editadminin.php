<?php

session_start();
require_once 'connect.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
}
require_once "connectmenu.php";
if (isset($_POST['update'])) {
    $iding = $_POST['iding'];
    $ingname = $_POST['ingname'];
    $ingdetail = $_POST['ingdetail'];
    $img = $_FILES['img'];
    $img2 = $_POST['img2'];
    $upload = $_FILES['img']['name'];

    if ($upload != '') {
        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'uploads/' . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                (move_uploaded_file($img['tmp_name'], $filePath));
            }
        }
    } else {
        $fileNew = $img2;
    }
    $sql = $conn->prepare("UPDATE ingredient SET ingname = :ingname,ingdetail =:ingdetail,img =:img WHERE iding= :iding");
    $sql->bindParam(":iding", $iding);
    $sql->bindParam(":ingname", $ingname);
    $sql->bindParam(":ingdetail", $ingdetail);
    $sql->bindParam(":img", $fileNew);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been Update successfully";
        header("location: admining.php");
    } else {
        $_SESSION['error'] = "Data has not been Update successfully";
        header("location: admining.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .container {
            max-width: 550px;
        }
    </style>
</head>

<body>



    <div class="container mt-5">
        <h1>Edit Data</h1>
        <hr>
        <form action="editadminin.php" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($_GET['iding'])) {
                $iding = $_GET['iding'];
                $stmt = $conn->query("select * from ingredient where iding = $iding");
                $stmt->execute();
                $data = $stmt->fetch();
            }
            ?>
            <div class="mb-3">
                <input type="text" readonly value="<?= $data['iding']; ?>" require class="form-control" name="iding">
                <label for="ingname" class="col-form-label">Name:</label>
                <input type="text" value="<?= $data['ingname']; ?>" require class="form-control" name="ingname">
                <input type="hidden" value="<?= $data['img']; ?>" require class="form-control" name="img2">
            </div>
            <div class="mb-3">
                <label for="ingdetail" class="col-form-label">ingdetail:</label>
                <input type="text" value="<?= $data['ingdetail']; ?>" require class="form-control" name="ingdetail">
            </div>
            <div class="mb-3">
                <label for="img" class="col-form-label">Image:</label>
                <input type="file" class="form-control" id="imgInput" name="img">
                <img width="100%" src="uploads/<?= $data['img']; ?>" id="previewImg" alt="">
            </div>

            <div class="modal-footer">
                <a class="btn btn-secondary" href="admining.php">Go Back</a>
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>
</body>

</html>