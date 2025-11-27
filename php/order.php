<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Order</title>
</head>

<body>
    <?php include "components/navbar.php";
    include "connection/connect.php";
    ?>
    <main>
        <div class="container">
            <?php
            $productquery = "SELECT * FROM `products` ORDER BY `prod_cat`, `prod_name`";
            $productresult = mysqli_query($connect, $productquery);
            if ($productresult->num_rows > 0) {
                $categories = [];
                while ($row = mysqli_fetch_assoc($productresult)) {
                    $categories[$row['prod_cat']][] = $row;
                }
            ?>

                <form method="post" class="order-form">
                    <div class="products-grid">
                        <?php foreach ($categories as $category => $products): ?>
                            <div class="category-section">
                                <h2 class="category-header"><?php echo htmlspecialchars($category); ?></h2>
                                <div class="products-container">
                                    <?php foreach ($products as $row):
                                        $prodid   = $row['prod_id'];
                                        $prodcat   = $row['prod_cat'];
                                        $prodimage = $row['prod_image'];
                                        $proddescr = $row['prod_descr'];
                                        $prodprice = $row['prod_price'];
                                        $prodname   = $row['prod_name'];

                                        include "components/UIcomponents/ordercheckbox.php";
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?> <button type="submit" name="makeorder" class="text-center w-full px-5 py-4 rounded-[100px] bg-indigo-600 text-white font-semibold hover:bg-indigo-700">Order now</button>
                    </div>
                </form>

            <?php } ?>


            <?php
            if (isset($_POST['makeorder'])) {
                // Check if user is logged in
                if (!isset($_SESSION['userid'])) {
                    echo "<div class='error-message'>Please log in to place an order.</div>";
                } elseif (!isset($_POST['products']) || empty($_POST['products'])) {
                    echo "<div class='error-message'>Please select at least one product.</div>";
                } else {
                    // Get the selected product IDs
                    $selectedProductIds = $_POST['products'];

                    // Fetch complete product data for selected products
                    $placeholders = implode(',', array_fill(0, count($selectedProductIds), '?'));
                    $stmt = mysqli_prepare($connect, "SELECT * FROM `products` WHERE `prod_id` IN ($placeholders)");

                    // Bind parameters
                    $types = str_repeat('i', count($selectedProductIds));
                    mysqli_stmt_bind_param($stmt, $types, ...$selectedProductIds);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    // Prepare order data array
                    $orderData = [];
                    while ($product = mysqli_fetch_assoc($result)) {
                        $orderData[] = [
                            "prod_id" => $product['prod_id'],
                            "prod_image" => $product['prod_image'],
                            "prod_descr" => $product['prod_descr'],
                            "prod_name" => $product['prod_name'],
                            "prod_price" => $product['prod_price'],
                            "prod_cat" => $product['prod_cat'],
                            "quantity" => 1 // You can modify this if you have quantity selection
                        ];
                    }

                    // Convert to JSON
                    $userorder_data = json_encode($orderData);
                    $user_id = $_SESSION['userid'];

                    // Insert into database
                    $insertStmt = mysqli_prepare($connect, "INSERT INTO `userorder`(`userorder_userid`, `userorder_data`, `userorder_time`) VALUES (?, ?, NOW())");
                    mysqli_stmt_bind_param($insertStmt, "is", $user_id, $userorder_data);

                    if (mysqli_stmt_execute($insertStmt)) {
                        $order_id = mysqli_insert_id($connect);
                        echo "<div class='success-message'>Order placed successfully! Order ID: #" . $order_id . "</div>";
                    } else {
                        echo "<div class='error-message'>Error placing order: " . mysqli_error($connect) . "</div>";
                    }

                    mysqli_stmt_close($insertStmt);
                    mysqli_stmt_close($stmt);
                    // header("location:ordercheckbox.php");
                }
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