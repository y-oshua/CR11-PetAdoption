<?php
session_start();
require_once "../../components/db_connect.php";


if (isset($_POST['adoptBtn'])) {
    $userid = $_SESSION['user'];
    $animalid = $_POST['animal_id'];
    $date = date('Y-m-d');


    $sql = "insert into adoptions (fk_user_id, fk_animal_id, date) values ('$userid', '$animalid', '$date')";
    if (mysqli_query($connect, $sql)) {
        header("Location: ../../home.php");
    } else {
        header("Location: ../../error.php");
    }
}
mysqli_close($connect);
