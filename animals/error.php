<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Error</title>

    <?php require_once '../components/boot.php' ?>
    <?php require_once '../components/links.php' ?>
    <link type="text/css" rel="stylesheet" href="../components/styles.css">
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Invalid Request</h1>
        </div>
        <div class="alert alert-warning" role="alert">
            <p>You've made an invalid request. Please <a href="../dashboard.php" class="alert-link">go back</a> to dashboard and try again.</p>
        </div>
    </div>
</body>

</html>