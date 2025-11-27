<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Dashboard</title>
</head>

<body>

    <?php
    include "connection/connect.php";
    include "components/navbar.php";
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: " . $baseURL . "login.php");
        exit;
    }

    ?>

    <div class="container mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">
            Welcome back,<?php if (isset($_SESSION['userusename'])): ?> <?php echo htmlspecialchars($_SESSION['userusename']); ?>!
        </h1>

    <?php else: ?>
        <p class="mb-4">You are not logged in.</p>
        <a href="<?php echo $baseURL; ?>login.php" class="bg-blue-600 text-white px-3 py-1 rounded">
            Log in
        </a>
    <?php endif; ?>
    </div>
    <main></main>

    <?php include "components/footer.php"; ?>


    <script src="../js/script.js"></script>
</body>

</html>