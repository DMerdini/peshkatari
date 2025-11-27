<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Order</title>
</head>

<body>
    <?php
    include "components/navbar.php";
    include "connection/connect.php";
    ?>
    <main>
        <div class="container">
            <h2>Your wishlist till now</h2>
            <?php
            $loggeduser = $_SESSION['userid'];
            $personalwishlistquery = "SELECT * FROM `wishlist` WHERE `user_id`='$loggeduser'";
            $personalwishlistresult = mysqli_query($connect, $personalwishlistquery);
            if ($personalwishlistresult->num_rows > 0) {
            ?>
                <table class="wishtable">
                    <thead>
                        <th>Nr</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Price</th>

                    </thead>
                    <tbody>
                        <?php
                        $tablenr = 0;

                        while ($row = mysqli_fetch_assoc($personalwishlistresult)) {
                            $tablenr++;
                            $wishtablenr = $tablenr;
                            $wishtablename  = $row['prod_name'];
                            $wishtableimage = $row['prod_image'];
                            $wishtableprice = $row['prod_price'];
                            include "components/UIcomponents/tablerow.php";
                        }


                        ?></tbody>
                </table>
            <?php
            } else {
            ?>
                <h3>No item added to wishlist yet!</h3>
            <?php
            }



            ?>
        </div>
    </main>
    <?php
    include "components/footer.php";
    ?>
</body>
<script src="../js/script.js"></script>

</html>