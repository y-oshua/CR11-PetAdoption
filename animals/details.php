<?php
session_start();

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../components/db_connect.php';

// select logged-in users details - procedural style
$userRes = mysqli_query($connect, "SELECT * FROM users WHERE user_id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($userRes, MYSQLI_ASSOC);

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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purfect Pets | Details</title>
    <?php require_once '../components/boot.php' ?>
    <?php require_once '../components/links.php' ?>
    <link type="text/css" rel="stylesheet" href="../components/styles.css">


</head>

<body>


    <!--begin navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <img class="img-thumbnail rounded-circle" src="../pictures/<?php echo $userRow['picture']; ?>" alt="<?php echo $userRow['first_name']; ?>">
            <p class="nav-item ms-2 text-light">Welcome <?php echo $userRow['first_name']; ?>!</p>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../home.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../update.php?id=<?php echo $_SESSION['user'] ?>">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php?logout">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--end navbar-->



    <!--begin .container-->

    <div class="container-fluid">

        <div class="container-fluid bg-light mx-auto">
            <fieldset class="w-75 mt-3 mx-auto">
                <legend class='h2 bg-dark text-light text-center p-3 mt-3'>Details <img class='img-thumbnail rounded' src='../pictures/<?php echo $picture ?>'></legend>


                <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <td><?php echo $name ?></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><?php echo $location ?></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><?php echo $description ?></td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td><?php echo $size ?></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><?php echo $age ?></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><?php echo $hobbies ?></td>
                    </tr>
                    <tr>
                        <th>Breed</th>
                        <td><?php echo $breed ?></td>
                    </tr>

                    <td><a href="../home.php"><button class="btn btn-success" type="button">Back</button></a></td>

                </table>

            </fieldset>
        </div>
    </div>

    <!--end .container-->

    <!--begin .footer-->
    <div class="footer bg-dark">
        <div class="footerContent">

            <img src="../pictures/facebook.png"><img src="../pictures/linkedin.png"><img src="../pictures/instagram.png"><img src="../pictures/youtube.png">
            <h2>Sign up for our newsletter!</h2>
            <br>
            <input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="johndoe@email.com">
            <br>
            <button class="btn btn-primary" type="submit">Subscribe</button>
            <br><br>
            <small class="text-muted">Created by Joshua Powell</small>
            <small class="text-muted">&copy; 2022</small>
        </div>
    </div>
    <!--end .footer-->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js'></script>

</body>

</html>