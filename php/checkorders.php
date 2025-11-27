<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>My Orders</title>
    <style>

    </style>
</head>

<body>
    <?php
    include "components/navbar.php";
    include "connection/connect.php";


    if (!isset($_SESSION['userid'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['userid'];

    // Fetch user's orders
    $orderQuery = "SELECT * FROM `userorder` WHERE `userorder_userid` = ? ORDER BY `userorder_time` DESC";
    $stmt = mysqli_prepare($connect, $orderQuery);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $orderResult = mysqli_stmt_get_result($stmt);
    $totalOrders = mysqli_num_rows($orderResult);

    // Calculate total spent
    $totalSpent = 0;
    $orders = [];
    while ($order = mysqli_fetch_assoc($orderResult)) {
        $orders[] = $order;
        $orderData = json_decode($order['userorder_data'], true);
        foreach ($orderData as $product) {
            $totalSpent += floatval($product['prod_price']) * intval($product['quantity']);
        }
    }
    ?>

    <main>
        <div class="container">
            <div class="orders-container">
                <h1 class="page-title">My Orders</h1>

                <?php if ($totalOrders > 0): ?>

                    <!-- Order Statistics -->
                    <div class="orders-stats">
                        <div class="stat-card">
                            <div class="stat-number"><?php echo $totalOrders; ?></div>
                            <div class="stat-label">Total Orders</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">$<?php echo number_format($totalSpent, 2); ?></div>
                            <div class="stat-label">Total Spent</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number"><?php echo count($orders); ?></div>
                            <div class="stat-label">Active Orders</div>
                        </div>
                    </div>

                    <!-- Orders List -->
                    <?php foreach ($orders as $order):
                        $orderData = json_decode($order['userorder_data'], true);
                        $totalAmount = 0;
                        $itemCount = 0;

                        foreach ($orderData as $product) {
                            $totalAmount += floatval($product['prod_price']) * intval($product['quantity']);
                            $itemCount += intval($product['quantity']);
                        }

                        // Determine status class
                        $status = $order['userorder_status'] ?? 'processing';
                        $statusClass = 'status-' . $status;
                    ?>

                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <div class="order-id">Order #<?php echo $order['userorder_id']; ?></div>
                                    <div class="order-date">
                                        <?php echo date('F j, Y g:i A', strtotime($order['userorder_time'])); ?>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="status-badge <?php echo $statusClass; ?>">
                                        <?php echo ucfirst($status); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="order-products">
                                <?php foreach ($orderData as $product): ?>
                                    <div class="product-item">
                                        <div class="product-image">
                                            <img src="<?php echo htmlspecialchars($product['prod_image']); ?>"
                                                alt="<?php echo htmlspecialchars($product['prod_name']); ?>"
                                                onerror="this.src='https://via.placeholder.com/70x70?text=No+Image'">
                                        </div>
                                        <div class="product-info">
                                            <div class="product-name"><?php echo htmlspecialchars($product['prod_name']); ?></div>
                                            <div class="product-category"><?php echo htmlspecialchars($product['prod_cat']); ?></div>
                                            <div class="product-description">
                                                <?php echo htmlspecialchars($product['prod_descr']); ?>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="product-price">$<?php echo number_format($product['prod_price'], 2); ?></div>
                                            <div class="text-sm text-gray-600 mt-1">Qty: <?php echo $product['quantity']; ?></div>
                                            <div class="text-sm text-gray-600 mt-1">
                                                Subtotal: $<?php echo number_format($product['prod_price'] * $product['quantity'], 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="order-footer mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
                                <div class="text-sm text-gray-600">
                                    <?php echo $itemCount; ?> item<?php echo $itemCount > 1 ? 's' : ''; ?>
                                </div>
                                <div class="text-right">
                                    <div class="order-total">
                                        Total: $<?php echo number_format($totalAmount, 2); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="no-orders">
                        <div class="text-6xl mb-6">📦</div>
                        <h2 class="text-3xl font-semibold mb-4">No orders yet</h2>
                        <p class="text-gray-600 mb-6 text-lg">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                        <a href="order.php" class="px-8 py-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-lg font-semibold">
                            🛍️ Start Shopping
                        </a>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include "components/footer.php"; ?>
</body>
<script src="../js/script.js"></script>

</html>