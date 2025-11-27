  <div class="relative w-xs border border-solid border-gray-200 rounded-2xl transition-all duration-500" id="<?php echo htmlspecialchars($prodid); ?>">

      <div class="prodcardframe block overflow-hidden">
          <img src="<?php echo htmlspecialchars($prodimage); ?>" alt="<?php echo htmlspecialchars($prodname); ?>" />
      </div>
      <div class="p-4">
          <h4 class="text-base font-semibold text-gray-900 mb-2 capitalize transition-all duration-500 "><?php echo htmlspecialchars($prodname); ?></h4>
          <p class="text-sm font-normal text-gray-500 transition-all duration-500 leading-5 mb-5"> <?php echo htmlspecialchars($proddescr); ?> </p>
          <h4 class="text-base font-semibold text-gray-900 mb-2 capitalize transition-all duration-500 "><?php echo htmlspecialchars($prodprice); ?></h4>
          <a href="menuitem.php?id=<?php echo htmlspecialchars($prodid); ?>" class="bg-indigo-600 shadow-sm rounded-full py-2 px-5 text-xs text-white font-semibold">Read More</a>
      </div>
  </div>