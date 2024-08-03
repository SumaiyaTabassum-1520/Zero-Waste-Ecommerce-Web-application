<?php

include 'materials/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

include 'materials/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'materials/user_header.php'; ?>

   <div class="home-bg">

      <section class="home">

         <div class="swiper home-slider">

            <div class="swiper-wrapper">

               <div class="swiper-slide slide" style="background-color: #89f6c3; color:black">
                  <div class="image">
                     <img src="photos\K1255-Paper-Cup-Flowers.jpg" alt="">
                  </div>
                  <div class="content">
                     <h3 style="color:black; font-size: 32px">আমরা আপনার দৈনন্দিন রুটিন তৈরি করি:<br><span class="txt" style=" font-size: 45px;color: #0b0b0b;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;background: linear-gradient(45deg,#2ddc1dc4,rgba(38, 192, 235, 0.801));"></span></h3>
                     <br><h3 style=" font-weight: bold;color:black; font-size: 30px">কেন আমাদের নির্বাচন করবেন?</h3><br>
                     <p style="font-size: 16px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    জিরো ওয়েস্ট -এ আমরা একটি ওয়েবসাইটের চেয়েও বেশি কিছু - আমরা টেকসই এবং জিরো ওয়েস্ট জীবনযাত্রার যাত্রায় আপনার অংশীদার। জিরো ওয়েস্ট জীবনধারা এবং পরিবেশগত স্থায়িত্বের প্রতি আপনার উত্সর্গের উপর জোর দিন। আমাদের ওয়েবসাইট টেকসই অনুশীলন প্রচার করে এবং বর্জ্য কমানোর সমাধান প্রদান করে।
                     </p><br>
                     <a href="shop.php" class="btn" style="background-color: green">আরও কিনুন</a>
                  </div>
               </div>

            </div>

            <div class="swiper-pagination"></div>

         </div>

      </section>

   </div>

   <section class="category">
   <br><h1 class="heading" style="font-weight: bold; ">ক্যাটাগরি দেখে <span style="color:green">কিনুন</span></h1>
     
      <div class="swiper category-slider">

         <div class="swiper-wrapper">

            <a href="category.php?category=Essentials" class="swiper-slide slide">
               <img src="photos\zws-essentials-zws-essentials-plastic-free-laundry-detergent-sheets-31077983387759.webp" alt="">
               <h3>এসেন্সিয়াল</h3>
            </a>

            <a href="category.php?category=Household" class="swiper-slide slide">
               <img src="photos\stasher-reusable-silicone-sandwich-bag-8-colors-31247120957551.webp" alt="">
               <h3>হাউজহোল্ড</h3>
            </a>

            <a href="category.php?category=Kitchen" class="swiper-slide slide">
               <img src="photos\earth-element-butter-dish-31101574283375.webp" alt="">
               <h3>কিচেন</h3>
            </a>

            <a href="category.php?category=Hair" class="swiper-slide slide">
               <img src="photos\suds-co-shampoo-bar-30555122237551.webp" alt="">
               <h3>হেয়ার কেয়ার</h3>
            </a>

            <a href="category.php?category=oral" class="swiper-slide slide">
               <img src="photos\zero-waste-store-bamboo-toothbrush-adult-zero-waste-toothbrush-plastic-free-compostable-castor-bean-bristles-30631985217647.webp" alt="">
               <h3>ওরাল হাইজিন</h3>
            </a>
         </div>
      </div>

   </section>

   <section class="home-products">
   <h1 class="heading" style="font-weight: bold;">নতুন <span style="color:green">প্রোডাক্ট</span></h1>

      <div class="swiper products-slider">

         <div class="swiper-wrapper">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <form action="" method="post" class="swiper-slide slide">
                     <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                     <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <div class="name">
                        <?= $fetch_product['name']; ?>
                     </div>
                     <div class="flex">
                        <div class="price"><span>$</span>
                           <?= $fetch_product['price']; ?><span>/-</span>
                        </div>
                        <input type="number" name="qty" class="qty" min="1" max="99"
                           onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <input type="submit" value="কার্টে যোগ করুন" class="btn" name="add_to_cart">
                  </form>
                  <?php
               }
            } else {
               echo '<p class="empty">no products added yet!</p>';
            }
            ?>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>
   <section class="about" id="about-us">
   <h1 class="heading" style="font-weight: bold;">আমাদের <span style="color:green">সম্পর্কিত</span>
   <marquee style="background-color: #a5f9a3;color:green">আপনার প্রতিটি সিদ্ধান্ত একটি প্রভাব আছে। <span style="font-weight: bold;color: black;">চলুন! এটি ইতিবাচক ভাবে যোগ করি।</span> </marquee>
    </h1>
      <div class="row">

         <div class="image">
            <img src="photos/unicorn-planter1-e1574217143542.webp" width="500" height="450" alt="text"  alt="">
         </div>
         <div class="content" style="color:black">
            <h3>জিরো ওয়েস্টে স্বাগতম!!</h3>
            <p>একটি টেকসই এবং শূন্য বর্জ্য জীবনধারা গ্রহণ করার জন্য আপনার গন্তব্যস্থল। আমরা একটি ওয়েবসাইটের চেয়ে বেশি; আমরা কারা এবং আমরা কিসের জন্য দাঁড়িয়েছি তার একটি আভাস এখানে দেওয়া হল:<br>
          <span >
            <u>আমাদের লক্ষ্য:</u><br>
            জিরো ওয়েস্টে, আমাদের লক্ষ্য হল মানুষকে অনুপ্রাণিত করা, শূন্য বর্জ্য জীবনধারার দিকে তাদের যাত্রা।
            <br><u>আমাদের দৃষ্টি</u><br>
            আমাদের দৃষ্টিভঙ্গি হল এই আন্দোলনের অগ্রভাগে থাকা, কারণ তারা আরও টেকসই জীবনযাত্রায় রূপান্তরিত হয়</span>
        </p>
            <a href="contact.php" class="btn">যোগাযোগ করুন</a>
         </div>

      </div>

   </section>









   <?php include 'materials/footer.php'; ?>
   <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
   <script>
      var typed = new Typed('.txt', {
         strings: ["জিরো ওয়েস্ট ", "টেকসই", "প্লাস্টিক - ফ্রি", "ভেগান"],
         loop: true,
         typeSpeed: 100,
         backSpeed: 80,
         backDelay: 1500,
      });
   </script>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>

      var swiper = new Swiper(".home-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });

      var swiper = new Swiper(".category-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 2,
            },
            650: {
               slidesPerView: 3,
            },
            768: {
               slidesPerView: 4,
            },
            1024: {
               slidesPerView: 5,
            },
         },
      });

      var swiper = new Swiper(".products-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            550: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });

   </script>

</body>

</html>