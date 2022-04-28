<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// select logged-in users details - procedural style
$userRes = mysqli_query($connect, "SELECT * FROM users WHERE user_id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($userRes, MYSQLI_ASSOC);


// // attempting filter button, multiple clicks
// $sql = "";
// $i = 0;
// if (isset($_POST['filterBtn'])) {    
//     $i++;
//     if ($i & 1) {
//         $sql = "SELECT * FROM animals WHERE age>7";
//     } else {
//         $sql = "SELECT * FROM animals";
//     }
// }
// $result = mysqli_query($connect, $sql);


$sql = "SELECT * FROM animals";
$result = mysqli_query($connect, $sql);

//this variable will hold the body for the cards
$cards = '';


if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {



        $cards .= "<div class='col'>
<div class='card h-100 shadow rounded'>
    <img src='pictures/" . $row['picture'] . "' class='card-img-top' alt='Photo of " . $row['name'] . "'>
    <div class='card-body'>
    <h5 class='card-title'>" . $row['name'] . "</h5>
    <hr>
    <p class='card-text'>Age: " . $row['age'] . "</p>
    <p class='card-text'>Location: " . $row['location'] . "</p>
    <p class='card-text'>Breed: " . $row['breed'] . "</p>
    <hr>
    <div class='btn-group-sm mx-auto' role='group'>
    <a href='animals/details.php?id=" . $row['animal_id'] . "'><button class='btn btn-outline-dark' type='button'>Details</button></a>
    <form action='animals/actions/a_adopt.php' method='post'><button class='btn btn-outline-dark' type='submit' name='adoptBtn'>Take me home!</button><input type='hidden' name='animal_id' value='$row[animal_id]'></form>

    </div>
    </div>
</div>
</div>";
    }
} else {
    $cards = "<div class='col'>
    <div class='card h-100'>
        <img src='error.jpg' class='card-img-top' alt='Error'>
        <div class='card-body'>
        <h5 class='card-title'>Error</h5>
        <p class='card-text'>No data to load</p>

        </div>
    </div>
    </div>";
}


$sql = "SELECT * FROM animals WHERE age>7";
$result = mysqli_query($connect, $sql);

if (isset($_POST['filterBtn'])) {
    $cards = '';


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

            $cards .= "<div class='col'>
        <div class='card h-100 shadow rounded'>
            <img src='pictures/" . $row['picture'] . "' class='card-img-top' alt='Photo of " . $row['name'] . "'>
            <div class='card-body'>
            <h5 class='card-title'>" . $row['name'] . "</h5>
            <hr>
            <p class='card-text'>Age: " . $row['age'] . "</p>
            <p class='card-text'>Location: " . $row['location'] . "</p>
            <p class='card-text'>Breed: " . $row['breed'] . "</p>
            <hr>
            <div class='btn-group-sm mx-auto' role='group'>
            <a href='animals/details.php?id=" . $row['animal_id'] . "'><button class='btn btn-outline-dark' type='button'>Details</button></a>
            <form action='animals/actions/a_adopt.php' method='post'><button class='btn btn-outline-dark' type='submit' name='adoptBtn'>Take me home!</button><input type='hidden' name='animal_id' value='$row[animal_id]'></form>
            </div>
            </div>
        </div>
        </div>";
        }
    } else {
        $cards = "<div class='col'>
    <div class='card h-100'>
        <img src='error.jpg' class='card-img-top' alt='Error'>
        <div class='card-body'>
        <h5 class='card-title'>Error</h5>
        <p class='card-text'>No data to load</p>

        </div>
    </div>
    </div>";
    }
}









mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purfect Pets | Home</title>
    <?php require_once 'components/boot.php' ?>
    <?php require_once 'components/links.php' ?>
    <link type="text/css" rel="stylesheet" href="components/styles.css">


</head>

<body>




    <!--begin navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <img class="img-thumbnail rounded-circle" src="pictures/<?php echo $userRow['picture']; ?>" alt="<?php echo $userRow['first_name']; ?>">
            <p class="nav-item ms-2 text-light">Welcome <?php echo $userRow['first_name']; ?>!</p>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="update.php?id=<?php echo $_SESSION['user'] ?>">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php?logout">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--end navbar-->



    <!--begin .container-->

    <div class="container-fluid">
        <!--begin .hero-->
        <div class="hero">
            <div class="text-block rounded">
                <h1>Purfect Pets</h1>
            </div>
        </div>
        <!--end .hero-->
        <form class="filter" method="post">
            <button class="btn btn-primary" name="filterBtn">Seniors Only</button>
            <button class="btn btn-primary" name="allAnimals">Display All</button>
        </form>
        <div id="row" class=" mt-2 row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php echo $cards ?>
        </div>
    </div>
    <!--end .container-->

    <!--begin .footer-->
    <div class="footer bg-dark">
        <div class="footerContent">

            <img src="pictures/facebook.png"><img src="pictures/linkedin.png"><img src="pictures/instagram.png"><img src="pictures/youtube.png">
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