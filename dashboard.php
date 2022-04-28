<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}


$sql = "SELECT * FROM animals";
$result = mysqli_query($connect, $sql);

//this variable will hold the body for the table
$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['name'] . "></td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['age'] . "</td>
            <td>" . $row['location'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td><a href='animals/update.php?id=" . $row['animal_id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='animals/delete.php?id=" . $row['animal_id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purfect Pets | Dashboard</title>
    <?php require_once 'components/boot.php' ?>
    <?php require_once 'components/links.php' ?>
    <link type="text/css" rel="stylesheet" href="components/styles.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img class="userImage" src="pictures/admavatar.png" alt="Adm avatar">
                <p class="">Administrator</p>

                <a class="btn btn-success" href="update.php?id=<?php echo $_SESSION['adm'] ?>">Edit Profile</a>
                <a class="btn btn-danger mt-1" href="logout.php?logout">Sign Out</a>

            </div>
            <div class="col-8 mt-2">
                <p class='h2'>Animals</p>
                <div class="mb-3">
                    <a href="animals/create.php"><button class='btn btn-primary' type="button">Add Pet</button></a>
                </div>

                <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Location</th>
                            <th>Breed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>