<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}


require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';



if ($_POST) {    
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $hobbies = $_POST['hobbies'];
    $breed = $_POST['breed'];
    $id = $_POST['id'];

    //variable for upload pictures errors is initialised
    $uploadError = '';

    $picture = file_upload($_FILES['picture'], 'animal'); //file_upload() called, animal as source needed, otherwise default is user
    if ($picture->error === 0) {
        ($_POST["picture"] == "animal.png") ?: unlink("../../pictures/$_POST[picture]");
        $sql = "UPDATE animals SET name = '$name', location = '$location', description = '$description', size = '$size', age = $age, hobbies = '$hobbies', breed = '$breed', picture = '$picture->fileName' WHERE animal_id = {$id}";
    } else {
        $sql = "UPDATE animals SET name = '$name', location = '$location', description = '$description', size = '$size', age = $age, hobbies = '$hobbies', breed = '$breed' WHERE animal_id = {$id}";
    }
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Purfect Pets | Update Pet Details</title>
    <?php require_once '../../components/boot.php' ?>
    <?php require_once '../../components/links.php' ?>
    <link type="text/css" rel="stylesheet" href="../../components/styles.css">
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update.php?id=<?= $id; ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../../dashboard.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>