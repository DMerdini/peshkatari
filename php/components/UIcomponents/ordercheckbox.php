<div class="formrow">
    <input type="checkbox" name="products[]" id="<?php echo 'productid' . $prodid; ?>" value="<?php echo $prodid; ?>">
    <label for="<?php echo 'productid' . $prodid; ?>">
        <div class="prodviewrow">
            <h3><?php echo htmlspecialchars($prodname); ?></h3>
            <h2>$<?php echo htmlspecialchars($prodprice); ?></h2>
        </div>
    </label>
</div>