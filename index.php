<?php
include "./shared/common.php";
include "./shared/DBconnection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- FAVICON -->
   <link rel="shortcut icon" href="assets/img/book.png" type="image/x-icon">

   <!-- REMIXICONS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
   <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">


   <!-- SWIPER CSS -->
   <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

   <!-- CSS -->
   <link rel="stylesheet" href="assets/css/style.css">

   <title>Book Hub</title>
</head>

<body>
   <!-- HEADER -->
   <header class="header" id="header">
      <nav class="nav container">
         <a href="#" class="nav__logo">
            <i class="ri-book-3-line"></i> Book Hub
         </a>

         <div class="nav__menu">
            <ul class="nav__list">
               <li class="nav__item">
                  <a href="#home" class="nav__link active-link">
                     <i class="ri-home-line"></i>
                     <span>Home</span>
                  </a>
               </li>

               <li class="nav__item">
                  <a href="#featured" class="nav__link">
                     <i class="ri-book-3-line"></i>
                     <span>Best Seller</span>
                  </a>
               </li>

               <li class="nav__item">
                  <a href="#discount" class="nav__link">
                     <i class="ri-price-tag-3-line"></i>
                     <span>Discount</span>
                  </a>
               </li>

               <li class="nav__item">
                  <a href="#new" class="nav__link">
                     <i class="ri-bookmark-line"></i>
                     <span>Latest</span>
                  </a>
               </li>

               <li class="nav__item">
                  <a href="#testimonial" class="nav__link">
                     <i class="ri-message-3-line"></i>
                     <span>Reviews</span>
                  </a>
               </li>
            </ul>
         </div>

         <div class="nav__actions">
            <!-- Search button -->
            <i class="ri-search-line search-button" id="search-button"></i>

            <!-- Login button -->
            <i class="ri-user-line login-button" id="login-button"></i>

            <!-- Theme button -->
            <i class="ri-moon-line change-theme" id="theme-button"></i>

            <!--cart-->
            <i class="ri-shopping-cart-line cart-button" id="cart-button"></i>
         </div>
      </nav>
   </header>

   <!-- SEARCH -->
   <div class="search" id="search-content">
      <form action="" class="search__form">
         <i class="ri-search-line search__icon"></i>
         <input type="search" placeholder="What are you looking for?" class="search__input">
      </form>

      <i class="ri-close-line search__close" id="search-close"></i>
   </div>

   <!-- LOGIN -->
   <div class="login grid" id="login-content">
      <?php include("./components/loginForm.php"); ?> 

      <!-- REGISTER -->
     <?php include("./components/registerForm.php"); ?>
      <div class="login__form grid"
         <?php
         if (!isset($_SESSION["logged"]) || $_SESSION["logged"] == "") {
            echo "style='display: none;'";
         }
         ?>>
         <i class="ri-user-line" style="width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; background: var(--first-color); border-radius: 50%; color: var(--border-color); font-size: 30px; margin: 0 auto;"></i>
         <div>
            <h3 class="SignUp__title" style="margin: 0;">
               <?php
               if (isset($_SESSION["logged"]) && $_SESSION["logged"] != "") {

                  $stmt = $connection->prepare("SELECT userName FROM users WHERE userEmail = ?");
                  $stmt->bind_param("s", $_SESSION['logged']);
                  $stmt->execute();
                  $result = $stmt->get_result();

                  if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                        echo $row["userName"];
                     }
                  } else {
                     echo "N/A";
                  }
                  // Close connection
                  $connection->close();
               } else {
                  echo "N/A";
               }

               ?>
            </h3>
            <h4 style="color: var(--text-color); margin: 0;">
               <?php
               echo ($_SESSION["logged"] != "" ? $_SESSION["logged"] : "N/A");
               ?></h4>
            <br />
            <a href="./editProfile.php" style="color: var(--first-color);">Edit Profile</a>
         </div>
         <a href="./actions/logout.php" style="width: 110px; margin: 0 auto;" onClick="return logoutConfirmation();">
            <button style="padding: 10px 20px; background: var(--text-color); color: var(--border-color); font-weight: bold; border-radius: 8px; cursor: pointer;">Log out</button>
         </a>
      </div>
      <i class="ri-close-line login__close" id="login-close"></i>
   </div>




   <!-- cart -->





   <!-- MAIN -->
   <main class="main">
      <!--HOME-->
      <section class="home section" id="home">
         <div class="home__container container grid">
            <div class="home__data">
               <h1 class="home__title">
               Discover a world of stories 
               with our vast collection of books
               </h1>

               <p class="home__description">
               Embark on a journey through words and imagination. From timeless classics to modern masterpieces,
                uncover stories that inspire, thrill, and captivate. Dive into a world where every page turns into an adventure,
                 and every book feels like home. Your next story awaits—start exploring today!
               </p>

               <a href="./About us.php" class="button">About Us</a>
            </div>

            <div class="home__images">
               <div class="home__swiper swiper">
                  <div class="swiper-wrapper">
                     <article class="home__article swiper-slide">
                        <img src="assets/img/lightning.jpg" alt="image" class="home__img">
                     </article>

                     <article class="home__article swiper-slide">
                        <img src="assets/img/ferno.jpg" alt="image" class="home__img">
                     </article>

                     <article class="home__article swiper-slide">
                        <img src="assets/img/tom.jpg" alt="image" class="home__img">
                     </article>

                     <article class="home__article swiper-slide">
                        <img src="assets/img/black.jpg" alt="image" class="home__img">
                     </article>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <!-- SERVICES -->
      <section class="services section">
         <div class="services__container container grid">

         <article class="services__card">
               <i class="ri-lock-2-line"></i>
               <h3 class="services__title">Secure Payment</h3>
               <p class="services__description">Secure Online Payments</p>
            </article>

            <article class="services__card">
               <i class="ri-truck-line"></i>
               <h3 class="services__title">Free Shipping</h3>
               <p class="services__description">Order More Than Rs 2000</p>
            </article>

          
            <article class="services__card">
               <i class="ri-customer-service-2-line"></i>
               <h3 class="services__title">Round the Clock Service</h3>
               <p class="services__description">Contact Us Anytime</p>
            </article>
         </div>
      </section>

      <!-- FEATURED -->
      <section class="featured section" id="featured">
         <h2 class="section__title">
            Best Sellers
         </h2>

         <div class="featured__container container">
            <div class="featured__swiper swiper">
               <div class="swiper-wrapper">
                  <article class="featured__card swiper-slide">
                     <img src="assets/img/harry_potter.jpg" alt="harry_potter_book" class="featured__img">

                     <h2 class="featured__title">Harry Potter</h2>
                     <div class="featured__prices">
                        <span class="featured__discount">Rs 1100</span>
                        <span class="featured__price">Rs 1990</span>
                     </div>

                     <button class="button">Add To Cart</button>

                     <div class="featured__actions">
                        
                        <button><i class="ri-heart-3-line"></i></button>
                        <button><i class="ri-eye-line"></i></button>
                     </div>
                  </article>

                  <article class="featured__card swiper-slide">
                     <img src="assets/img/lord_of_the_rings.jpg" alt="lordOfTheRings_book" class="featured__img">

                     <h2 class="featured__title">Lord of the Rings</h2>
                     <div class="featured__prices">
                        <span class="featured__discount">Rs 2500</span>
                        <span class="featured__price">Rs 2900</span>
                     </div>

                     <button class="button">Add To Cart</button>

                     <div class="featured__actions">
                        <button><i class="ri-heart-3-line"></i></button>
                        <button><i class="ri-eye-line"></i></button>
                     </div>
                  </article>



                  <article class="featured__card swiper-slide">
                     <img src="assets/img/GoT.jpg" alt="Narnia_book" class="featured__img">

                     <h2 class="featured__title">Game Of Thrones</h2>
                     <div class="featured__prices">
                        <span class="featured__discount">Rs 3000</span>
                        <span class="featured__price">Rs 3500</span>
                     </div>

                     <button class="button">Add To Cart</button>

                     <div class="featured__actions">
                        <button><i class="ri-heart-3-line"></i></button>
                        <button><i class="ri-eye-line"></i></button>
                     </div>
                  </article>

                  <article class="featured__card swiper-slide">
                     <img src="assets/img/ice_and_fire.jpg" alt="GameOfThrons_book" class="featured__img">

                     <h2 class="featured__title">The Song of ICE & FIRE</h2>
                     <div class="featured__prices">
                        <span class="featured__discount">Rs 1400
                        <span class="featured__price">Rs 19999</span>
                     </div>

                     <button class="button">Add To Cart</button>

                     <div class="featured__actions">
                        <button><i class="ri-heart-3-line"></i></button>
                        <button><i class="ri-eye-line"></i></button>
                     </div>
                  </article>

                  
                

                  <article class="featured__card swiper-slide">
                     <img src="assets/img/hunger_games.jpg" alt="HungeGames_book" class="featured__img">

                     <h2 class="featured__title">Hunger Games</h2>
                     <div class="featured__prices">
                        <span class="featured__discount">Rs 2500</span>
                        <span class="featured__price">Rs 3000</span>
                     </div>

                     <button class="button">Add To Cart</button>

                     <div class="featured__actions">
                        <button><i class="ri-search-line"></i></button>
                        <button><i class="ri-heart-3-line"></i></button>
                        <button><i class="ri-eye-line"></i></button>
                     </div>
                  </article>

                  <article class="featured__card swiper-slide">
                     <img src="assets/img/percy_jacson.jpg" alt="Percy_Jackson_book" class="featured__img">

                     <h2 class="featured__title">Percy Jackson</h2>
                     <div class="featured__prices">
                        <span class="featured__discount">Rs 3100</span>
                        <span class="featured__price">Rs 3500</span>
                     </div>

                     <button class="button">Add To Cart</button>

                     <div class="featured__actions">
                        <button><i class="ri-search-line"></i></button>
                        <button><i class="ri-heart-3-line"></i></button>
                        <button><i class="ri-eye-line"></i></button>
                     </div>
                  </article>
               </div>

               <div class="swiper-button-prev">
                  <i class="ri-arrow-left-s-line"></i>
               </div>

               <div class="swiper-button-next">
                  <i class="ri-arrow-right-s-line"></i>
               </div>
            </div>
         </div>
      </section>

      <!-- DISCOUNT -->
      <section class="discount section" id="discount">
         <div class="discount__container container grid">
            <div class="discount__data">
               <h2 class="discount__title section__title">
                  Special Discounts
               </h2>

               <p class="discount__description">
                  Receive 50% Discounts for the special Wimpy Kid editions<br>
                  only available for a limited time.
               </p>

               <a href="#" class="button">Buy Now</a>
            </div>

            <div class="discount__images">
               <img src="assets/img/rodrick.jpg" alt="Pride&pregeudies_book" class="discount__img-1">
               <img src="assets/img/wimpy.jpg" alt="Mother_book" class="discount__img-2">
            </div>
         </div>
      </section>

      <!-- NEW BOOKS -->
      <section class="new section" id="new">
         <h2 class="section__title">
            New Books
         </h2>

         <div class="new__container container">
            <div class="new__swiper swiper">
               <div class="swiper-wrapper">
                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_1.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">The Dragon Knight's Curse</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_21.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">The HOBBIT</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_3.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">A tea spoon of heart and sea</h2>
                        <div class="new__prices">
                           <span class="new__discount">Rs 1500</span>
                           <span class="new__price">Rs 1900</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_4.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">The Goldfinch</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_5.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">Memoris Combatant</h2>
                        <div class="new__prices">
                           <span class="new__discount">Rs 1200</span>
                           <span class="new__price">Rs 1450</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_6.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">SULMAN RUSHDIE</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_7.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">Tell the wolves I'm home</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_8.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">Heart of a SAMURAI</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_9.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">FRANKENSTEIN</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_10.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">All my friends are DEAD</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>
               </div>
            </div>

            <div class="new__swiper swiper">
               <div class="swiper-wrapper">
                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_10.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">All my friends are DEAD</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_9.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">FRANKENSTEIN</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_8.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">Heart of a SAMURAI</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_7.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">Tell the wolves I'm home</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_6.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">SULMAN RUSHDIE</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_5.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">Memoris Combatant</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_4.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">The Goldfinch</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_3.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">A tea spoon of heart and sea</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_21.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">The HOBBIT</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>

                  <a href="#" class="new__card swiper-slide">
                     <img src="assets/img/new_1.jpg" alt="image" class="new__img">

                     <div>
                        <h2 class="new__title">The Dragon Knight's Curse</h2>
                        <div class="new__prices">
                           <span class="new__discount">$7.99</span>
                           <span class="new__price">$14.99</span>
                        </div>

                        <div class="new__stars">
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-fill"></i>
                           <i class="ri-star-half-fill"></i>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>
      </section>

      <!-- JOIN -->
      <section class="join section">
         <div class="join__container">
            <img src="assets/img/library.jpg" alt="image" class="join__bg">

            <div class="join__data container grid">
               <h2 class="join__title section__title">
                  Subscribe To Receive <br>
                  Our Latest Offers and Books.
               </h2>

               <form action="" class="join__form">
                  <input type="email" placeholder="Enter email" class="join__input">
                  <button type="submit" class="join__button button">Subscribe</button>
               </form>
            </div>
         </div>
      </section>

      <!-- TESTIMONIAL -->
      <section class="testimonial section" id="testimonial">
         <h2 class="section__title">
            Our Latest Reviews
         </h2>

         <div class="testimonial__container container">
            <div class="testimonial__swiper swiper">
               <div class="swiper-wrapper">
                  <article class="testimonial__card swiper-slide">
                     <img src="assets/img/test_1.jpeg" alt="img" class="testimonial__img">

                     <h2 class="testimonial__title">Tom Frank</h2>
                     <p class="testimonial__description">
                        The best website to buy books, the purchase
                        is very easy to make and has great discounts.
                     </p>

                     <div class="testimonial__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </article>

                  <article class="testimonial__card swiper-slide">
                     <img src="assets/img/test_2.jpeg" alt="img" class="testimonial__img">

                     <h2 class="testimonial__title">Natalia Lopezz</h2>
                     <p class="testimonial__description">
                        The best website to buy books, the purchase
                        is very easy to make and has great discounts.
                     </p>

                     <div class="testimonial__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </article>

                  <article class="testimonial__card swiper-slide">
                     <img src="assets/img/test_3.jpeg" alt="img" class="testimonial__img">

                     <h2 class="testimonial__title">Pasindu Sahansith</h2>
                     <p class="testimonial__description">
                        The best website to buy books, the purchase
                        is very easy to make and has great discounts.
                     </p>

                     <div class="testimonial__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </article>

                  <article class="testimonial__card swiper-slide">
                     <img src="assets/img/test_4.jpeg" alt="img" class="testimonial__img">

                     <h2 class="testimonial__title">Camila Cabello</h2>
                     <p class="testimonial__description">
                        The best website to buy books, the purchase
                        is very easy to make and has great discounts.
                     </p>

                     <div class="testimonial__stars">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                     </div>
                  </article>
               </div>
            </div>
         </div>
      </section>
   </main>

   <!-- FOOTER -->
   <footer class="footer">
      <div class="footer__container container grid">
         <div>
            <a href="#" class="footer__logo">
               <i class="ri-book-3-line"></i> Book Hub
            </a>

            <p class="footer__description">
               Find and explore the best <br>
               eBooks from all your <br>
               favorite Authors form Book Hub.
            </p>
         </div>

         <div class="footer__data grid">
            <div>
               <h3 class="footer__title">About</h3>

               <ul class="footer__links">
                  <li>
                     <a href="#" class="footer__link">Awards</a>
                  </li>

                  <li>
                     <a href="#" class="footer__link">FAQs</a>
                  </li>

                  <li>
                     <a href="#" class="footer__link">Privacy policy</a>
                  </li>

                  <li>
                     <a href="#" class="footer__link">Terms of services</a>
                  </li>
               </ul>
            </div>

            <div>
               <h3 class="footer__title">Company</h3>

               <ul class="footer__links">
                  <li>
                     <a href="#" class="footer__link">Blogs</a>
                  </li>

                  <li>
                     <a href="#" class="footer__link">Community</a>
                  </li>

                  <li>
                     <a href="#" class="footer__link">Our team</a>
                  </li>

                  <li>
                     <a href="#" class="footer__link">Help center</a>
                  </li>
               </ul>
            </div>

            <div>
               <h3 class="footer__title">Contact</h3>

               <ul class="footer__links">
                  <li>
                     <address class="footer__info">
                        No.36/2 <br>
                        Galle Road Colombo<br>
                        SriLanka
                     </address>
                  </li>

                  <li>
                     <address class="footer__info">
                        bookhub@email.com <br>
                        01114856869
                     </address>
                  </li>
               </ul>
            </div>

            <div>
               <h3 class="footer__title">Social</h3>

               <div class="footer__social">
                  <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                     <i class="ri-facebook-circle-line"></i>
                  </a>

                  <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                     <i class="ri-instagram-line"></i>
                  </a>

                  <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                     <i class="ri-twitter-x-line"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>

      <span class="footer__copy">
         &#169; All Rights Reserved By Book Hub
      </span>
   </footer>

   <!-- SCROLL UP -->
   <a href="#" class="scrollup" id="scroll-up">
      <i class="ri-arrow-up-line"></i>
   </a>

   <!-- SCROLLREVEAL -->
   <script src="assets/js/scrollreveal.min.js"></script>

   <!-- SWIPER JS -->
   <script src="assets/js/swiper-bundle.min.js"></script>

   <!-- MAIN JS -->
   <script src="assets/js/main.js"></script>

   <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
   <script src="./assets/js/validations.js" async defer></script>
   <script>
      const authChange = (to) => {
         if (to == "register") {
            document.getElementById("registerForm").removeAttribute('style');
            document.getElementById("loginForm").setAttribute('style', 'display: none;');
         } else {
            document.getElementById("loginForm").removeAttribute('style');
            document.getElementById("registerForm").setAttribute('style', 'display: none;');
         }
      }
   </script>
</body>

</html>