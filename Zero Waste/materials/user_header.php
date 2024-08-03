<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
   }
}
?>
<link rel="stylesheet" href="../css/style.css">
<header class="header">

   <section class="flex">
      <a  href="home.php" class="logo" style="font-weight: bold;">জিরো<span style="color:green;font-weight: bold;">ওয়েস্ট</span></a>

      <nav class="navbar" style="margin-left: 150px; margin-right:150px">
         <a href="home.php">হোম</a>
         <a href="#about-us">সম্পর্কিত</a>
         <a href="orders.php">অর্ডার</a>
         <a href="shop.php">শপ</a>
         <a href="contact.php">যোগাযোগ</a>
      </nav>

      <div class="icons">
          <?php
         $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
         $count_wishlist_items->execute([$user_id]);
         $total_wishlist_counts = $count_wishlist_items->rowCount();

         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_counts = $count_cart_items->rowCount();
         ?> 
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(
               <?= $total_wishlist_counts; ?>)
            </span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(
               <?= $total_cart_counts; ?>)
            </span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p>
               <?= $fetch_profile["name"]; ?>
            </p>
            <a href="update_user.php" class="btn"> আপডেট প্রোফাইল</a>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">রেজিস্টার</a>
               <a href="user_login.php" class="option-btn">লগইন</a>
            </div>
            <a href="materials/user_logout.php" class="delete-btn"
               onclick="return confirm('logout from the website?');">লগ আউট</a>
            <?php
         } else {
            ?>
            <p>প্লিজ রেজিস্টার করুন!</p>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">রেজিস্টার</a>
               <a href="user_login.php" class="option-btn">লগইন</a>
            </div>
            <?php
         }
         ?>


      </div>

   </section>

</header>