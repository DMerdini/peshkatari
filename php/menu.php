<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Our Menu</title>
</head>

<body>

    <?php
    include "components/navbar.php";
    include "connection/connect.php";
    ?>

    <div class="container">
        <?php
        $productquery = "SELECT * FROM `products`";
        $productresult = mysqli_query($connect, $productquery);
        if ($productresult->num_rows > 0) {

        ?>
            <div class="productgrid">
                <?php
                while ($row = mysqli_fetch_assoc($productresult)) {
                    $prodid   = $row['prod_id'];
                    $prodcat   = $row['prod_cat'];
                    $prodimage = $row['prod_image'];
                    $proddescr = $row['prod_descr'];
                    $prodprice = $row['prod_price'];
                    $prodname   = $row['prod_name'];

                    include "components/UIcomponents/prodcard.php";
                }   ?>
            </div>
        <?php } else { ?>
            <h1>Nuk ka produkte</h1>
        <?php  } ?>
    </div>
    <?php
    include "components/footer.php";
    ?>
</body>
<script src="../js/script.js"></script>

</html>