
<?php
    session_start();

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 7200)) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
    $_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>About US</title>
</head>

<body>
    <?php include "components/navbar.php";
    ?>

    <?php
    include "components/footer.php";
    ?>

</body>
<script src="../js/script.js"></script>

</html>