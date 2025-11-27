<nav>
    <div class="container">
        <?php
        session_start();
        ?>
        <?php
        $baseURL = "http://localhost/peshkatari/php/";
        ?>

        <a href="<?php echo $baseURL; ?>" class="toplogo" style="display:flex;align-items:center">
            <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px">
                <path d="M440-120q-100 0-170-70t-70-170v-240l200 200-56 57-64-64v47q0 66 47 113t113 47q66 0 113-47t47-113v-127q-36-14-58-44.5T520-600q0-38 22-68.5t58-44.5v-167h80v167q36 14 58 44.5t22 68.5q0 38-22 69t-58 44v127q0 100-70 170t-170 70Zm200-440q17 0 28.5-11.5T680-600q0-17-11.5-28.5T640-640q-17 0-28.5 11.5T600-600q0 17 11.5 28.5T640-560Zm0-40Z" />
            </svg>
            <h3 style="font-size:20px">Peshkatari</h3>
        </a>

        <ul class="navul">

            <li class="navli"><a href="<?php echo $baseURL; ?>index.php">Home</a></li>
            <li class="navli"><a href="<?php echo $baseURL; ?>about.php">About Us</a></li>
            <li class="navli"><a href="<?php echo $baseURL; ?>menu.php">Menu</a></li>
            <li class="navli"><a href="<?php echo $baseURL; ?>contact.php">Contact</a></li>
            <li class="navli"><a href="<?php echo $baseURL; ?>order.php">Order</a></li>

        </ul>

        <?php

        if (isset($_SESSION['userusename'])) {
        ?>
            <div class="custom-select-wrapper">
                <div class="custom-select">
                    <span class="custom-select-trigger">Account</span>
                    <div class="custom-options">
                        <a href="<?php echo $baseURL; ?>dashboard.php" class="custom-option">Profile</a>
                        <a href="<?php echo $baseURL; ?>wishlist.php" class="custom-option">wishlist</a>
                        <a href="<?php echo $baseURL; ?>checkorders.php" class="custom-option">check Order</a>
                        <form method="post" class="custom-option">
                            <button name="logout">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['logout'])) {
                session_unset();
                session_destroy();
                header("Location: " . $baseURL . "login.php");
                exit;
            }
        } else {
            ?>
            <a href="<?php echo $baseURL; ?>login.php" class="loginopt">Log in</a>
        <?php
        }

        ?>
    </div>
</nav>


<script>
    document.querySelector('.custom-select-trigger').addEventListener('click', function(e) {
        this.parentElement.classList.toggle('opened');
        e.stopPropagation();
    });

    document.addEventListener('click', function() {
        document.querySelector('.custom-select').classList.remove('opened');
    });
</script>