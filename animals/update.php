<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE animal_id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['name'];
        $location = $data['location'];
        $description = $data['description'];
        $size = $data['size'];
        $age = $data['age'];
        $hobbies = $data['hobbies'];
        $breed = $data['breed'];
        $picture = $data['picture'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Animal</title>

    <?php require_once '../components/boot.php' ?>
    <?php require_once '../components/links.php' ?>
    <link type="text/css" rel="stylesheet" href="../components/styles.css">
</head>

<body>
    <fieldset>
        <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><input class="form-control" type="text" name="name" placeholder="Sir Barks-alot" value="<?php echo $name ?>" /></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><input class="form-control" type="text" name="location" placeholder="Houston" value="<?php echo $location ?>" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class="form-control" type="text" name="description" placeholder="Cute, fuzzy, doggo." value="<?php echo $description ?>" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class="form-control" type="text" name="size" placeholder="5 foot tall, 95 lbs" value="<?php echo $size ?>" /></td>
                </tr>

                <tr>
                    <th>Age</th>
                    <td><input class="form-control" type="number" name="age" step="any" placeholder="Age" value="<?php echo $age ?>" /></td>
                </tr>
                <tr>
                    <th>Hobbies</th>
                    <td><input class="form-control" type="text" name="hobbies" placeholder="Chewing on socks" value="<?php echo $hobbies ?>" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class="form-control" type="text" name="breed" placeholder="Pitbull" value="<?php echo $breed ?>" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="file" name="picture" /></td>
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['animal_id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $data['picture'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="../dashboard.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>

</html>