<?php
session_start();
require_once "db.php";
if (isset($_POST["insert"])) {
    $id = $_POST["id"];
    $fullname = $_POST["fullname"];
    $serial = $_POST["serial"];
    $year = $_POST["year"];
    $wilaya = $_POST["wilaya"];
    $asserance_name = $_FILES["asserance"]["name"];
    $tempname_asserance = $_FILES["asserance"]["tmp_name"];
    $folder_asserance = "images/".$asserance_name;
    $license_name = $_FILES["license"]["name"];
    $tempname_license = $_FILES["license"]["tmp_name"];
    $folder_license = "images/".$license_name;



    $sql = "INSERT INTO users (id, fullname, serial_number, creation_year, wilaya, assurance, driving_license) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issssss",$id,  $fullname, $serial, $year, $wilaya, $asserance_name, $license_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if (move_uploaded_file($tempname_asserance, $folder_asserance) && move_uploaded_file($tempname_license, $folder_license)) {
        echo "file uploaded successfully";
    }
    else{
        echo "file not uploaded";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert</title>
    <script src="https://kit.fontawesome.com/609f0d26cb.js" crossorigin="anonymous"></script>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{
            width: 400px;
            border:solid 1px black;
            padding: 20px 20px;
            margin-top: 100px;
        }
        input{
            padding: 5px 10px;
            margin: 10px 5px;
        }
        .btn{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 150px;
            
            padding: 10px 20px;
            background: #5AB2FF;
            border: 1px black;
            border-radius: 4px;
        
        }
        .btn:hover{
            background: #378CE7;
        }
        
        .left{
            top: 30px;
            left: 30px;
            position: absolute;
            z-index: 100;
            color: #222;
        }
    </style>
</head>
<body>
<a href="admin.php"><i class="fa-regular fa-circle-left fa-3x left"></i></a>
    <?php
        if (isset($_SESSION["username"])) {
            ?>
            <form enctype="multipart/form-data" method="post">
                id <input type="number" placeholder="id" name="id" required><br>
                fullname <input type="text" placeholder="fullname" name="fullname" required><br>
                serial number <input type="text" placeholder="serial number" name="serial" required><br>
                creation year <input type="text" placeholder="creation year" name="year" required><br>
                wilaya <input type="text" placeholder="wilaya" name="wilaya" required><br>
                assurance <input type="file" placeholder="choose a file or hold and drop" name="asserance" required><br>
                driving license <input type="file" placeholder="choose a file or hold and drop" name="license" required><br>
                <input type="submit" value="insert" name="insert" class="btn">
            </form>


            <?php
        }else{
            header("location: login.php");
        }
    ?>
</body>
</html>