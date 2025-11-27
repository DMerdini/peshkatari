<?php


// product variables should already exist
// $prodid, $prodname, $prodimage, etc.

$loggeduser = $_SESSION['userid'];

// Check if already in wishlist
$checkWish = "SELECT * FROM wishlist WHERE user_id='$loggeduser' AND product_id='$prodid'";
$isInWishlist = mysqli_query($connect, $checkWish);
$inWishlist = mysqli_num_rows($isInWishlist) > 0;

// Toggle wishlist
if (isset($_POST['additemwish'])) {

    if ($inWishlist) {
        $deleteWish = "DELETE FROM wishlist WHERE user_id='$loggeduser' AND product_id='$prodid'";
        mysqli_query($connect, $deleteWish);
    } else {
        // INSERT INTO `wishlist`( `user_id`, `product_id`, `prod_image`, `prod_price`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')
        $addWish = "INSERT INTO wishlist (user_id, product_id, `prod_image`, `prod_price`,`prod_name`) 
                    VALUES ('$loggeduser','$prodid','$prodimage','$prodprice','$prodname')";
        mysqli_query($connect, $addWish,);
    }

    header("Refresh:0");
    exit();
}
?>

<section class="relative">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-0">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mx-auto max-md:px-2">

            <div class="img">
                <div class="img-box h-full max-lg:mx-auto">
                    <img src="<?php echo htmlspecialchars($prodimage); ?>"
                        class="max-lg:mx-auto lg:ml-auto h-full object-cover">
                </div>
            </div>

            <div class="data w-full lg:pr-8 pr-0 flex items-center">
                <div class="w-full max-w-xl">

                    <p class="text-lg font-medium text-indigo-600 mb-4">
                        Food / <?php echo htmlspecialchars($prodcat); ?>
                    </p>

                    <h2 class="font-manrope font-bold text-3xl mb-2">
                        <?php echo htmlspecialchars($prodname); ?>
                    </h2>

                    <h6 class="font-manrope font-semibold text-2xl text-gray-900 mb-4">
                        $<?php echo htmlspecialchars($prodprice); ?>
                    </h6>

                    <p class="text-gray-500 text-base mb-5">
                        <?php echo htmlspecialchars($proddescr); ?>
                    </p>

                    <div class="flex items-center gap-3">
                        <form method="post" class="relative group">
                            <button type="submit"
                                name="additemwish"
                                class="wish-btn transition-all duration-300 p-4 rounded-full bg-indigo-50 hover:bg-indigo-100 active:scale-110 hover:scale-110">

                                <?php if ($inWishlist) { ?>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        viewBox="0 0 24 24" fill="#ef4444">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                     2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                     C13.09 3.81 14.76 3 16.5 3
                     19.58 3 22 5.42 22 8.5
                     c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>

                                    <span
                                        class="absolute hidden group-hover:inline-block -bottom-10 left-1/2 -translate-x-1/2 bg-black text-white text-xs py-1 px-2 rounded">
                                        Already in wishlist
                                    </span>

                                <?php } else { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        viewBox="0 0 24 24" fill="none" stroke="#4F46E5" stroke-width="2">
                                        <path d="M12.1 21.35l-1.1-1.05C5.14 15.24 2 12.27 2 8.5
                     2 5.42 4.42 3 7.5 3
                     c1.74 0 3.41.81 4.5 2.09
                     C13.09 3.81 14.76 3 16.5 3
                     19.58 3 22 5.42 22 8.5
                     c0 3.77-3.13 6.74-8.9 11.79z" />
                                    </svg>
                                <?php } ?>
                            </button>
                        </form>

                        <button
                            class="text-center w-full px-5 py-4 rounded-[100px] bg-indigo-600 text-white font-semibold hover:bg-indigo-700">
                            Buy Now
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>