<?php

session_start();
require_once 'connect.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
}
require_once "connectmenu.php";

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM ingredient WHERE iding = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=admining.php");
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
</head>

<body>

    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add beans</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="inserting.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="ingname" class="col-form-label">Name:</label>
                            <input type="text" require class="form-control" name="ingname">
                        </div>
                        <div class="mb-3">
                            <label for="ingdetail" class="col-form-label">ingdetail:</label>
                            <input type="text" require class="form-control" name="ingdetail">
                        </div>
                        
                        <div class="mb-3">
                            <label for="img" class="col-form-label">Image:</label>
                            <input type="file" require class="form-control" iding="imgInput" name="img">
                            <img width="100%" iding="previewImg" alt="">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Admin</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Add Beans</button>
                <a href="main_in.php" class="btn btn-danger" >Main</a>
                <a href="logout.php" class="btn btn-danger">logout</a>
                
            </div>
        </div>
        <hr>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">details</th>
                    <th scope="col">Img</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stmt = $conn->query("SELECT * FROM ingredient");
                    $stmt->execute();
                    $ingredient = $stmt->fetchAll();

                    if (!$ingredient) {
                        echo "<tr><td colspan='6' class='text-center'>No ingredient found</td></tr>";
                    } else {
                        foreach ($ingredient as $ingredient) {                
                ?>
                <tr>
                    <th scope="row"><?= $ingredient['iding'] ?> </th>
                    <td><?= $ingredient['ingname'] ?></td>
                    <td><?= $ingredient['ingdetail'] ?></td>
                    <td width = "250px"><img width="100%" src="uploads/<?= $ingredient['img'] ?>" class="rounded" alt=""></td>
                    <td>
                        <a href="editadminin.php?iding=<?= $ingredient['iding'] ?>" class="btn btn-warning" >Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $ingredient['iding']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php  }
                    } ?>
            </tbody>
        </table>
    </div>
    <center>
    <a href="admin.php"  class="btn btn-warning" >Beans -> </a><br><br><br>

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