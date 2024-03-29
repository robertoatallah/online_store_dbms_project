<?php
session_start();
include("connection.php");
$user_id = $_SESSION["user_id"];
$sum_total = $_SESSION["sum_total"];
$cart_id = $_SESSION["cart_id"];
$payment_type = "cash";
$address = $_POST["firstName"]." ".$_POST["lastName"]." ".$_POST["phone"]." ".$_POST["company"]." ".$_POST["country"]." ".$_POST["address"]." ".$_POST["addressalt"]." ".$_POST["city"]." ".$_POST["state"]." ";
$query = $mysqli->prepare("UPDATE users SET address = '$address' WHERE  id = '$user_id'");
$query->execute();
$query = $mysqli->prepare("INSERT INTO payments ( payment_type, amount, carts_id ) VALUES(?, ? , ?)");
$query->bind_param("ssi", $payment_type, $sum_total, $cart_id); 
$query->execute();

$sql = " select * from payments order by id desc limit 1; ";  
$result = mysqli_query($con, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$payment_id = $row["id"];
$com = "DHL";
$time = "2 to 5 business days";
$query = $mysqli->prepare("INSERT INTO shipments ( shipment_company, estimated_shipment_time,  payments_id ) VALUES(?,?,?)");
$query->bind_param("ssi", $com, $time, $payment_id); 
$query->execute();



?>

<?php

include("connection.php");
$sql = "SELECT * FROM carts_contains_products;";
$result = $mysqli->query($sql);
$count = mysqli_num_rows($result); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>La Boutique Beirut | Ecommerce bootstrap template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- gLightbox gallery-->
    <link rel="stylesheet" href="vendor/glightbox/css/glightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
    <!-- Choices CSS-->
    <link rel="stylesheet" href="vendor/choices.js/public/assets/styles/choices.min.css">
    <!-- Swiper slider-->
    <link rel="stylesheet" href="vendor/swiper/swiper-bundle.min.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.png">
  </head>
  <body>
    <div class="page-holder">
      <!-- navbar-->
      <header class="header bg-white">
        <div class="container px-lg-3">
          <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.php"><span class="fw-bold text-uppercase text-dark">La Boutique Beirut</span></a>
            <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <!-- Link--><a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <!-- Link--><a class="nav-link" href="shop.php">Shop</a>
                </li>
               
                
              </ul>
              <ul class="navbar-nav ms-auto">               
              <?php
              if (isset($_SESSION["user_id"]) ) {
                ?>            
                <li class="nav-item"><a class="nav-link" href="cart.php"> <i class="fas fa-dolly-flatbed me-1 text-gray"></i>Cart<small class="text-gray fw-normal"><?php echo "(". $count . ")"?></small></a></li>
                <?php }?>
                <?php 
                if (isset($_SESSION["user_id"])) {
                ?>
                <li class="nav-item dropdown"><a class="nav-link droptown-toggle" id="pagesDropdown" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-user me-1 text-gray fw-normal"></i><?php echo $_SESSION['user_name'];?></a>
                  <div class="dropdown-menu mt-3 shadow-sm" aria-labelledby="pagesDropdown"><a class="dropdown-item border-0 transition-link" href="signOut.php">Sign Out</a></div>
                  </li>
                
                <?php }else{ ?>
                  <li class="nav-item"><a class="nav-link" href="login.php"> <i class="fas fa-user me-1 text-gray fw-normal"></i>Login</a></li>
                <?php }?>
              </ul>
            </div>
          </nav>
        </div>
      </header>

            <!-- ORDER SUMMARY-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Your order</h5>
                  <ul class="list-unstyled mb-0">
                  <?php   // LOOP TILL END OF DATA 
  
                    while($rows=$result->fetch_assoc())
                    {
                
                      $products_id = $rows['products_id'];
                      $carts_id = $rows['carts_id'];
                      $sql2 = "SELECT * FROM products WHERE id='$products_id';";
                      $result2 = $mysqli->query($sql2);
                      $product = $result2->fetch_assoc();
                       
                  ?>
                    <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold"><?php echo $product['name']?></strong><span class="text-muted small"><?php echo $product['price']?></span></li>
                    <li class="border-bottom my-2"></li>
                    <?php
                    }
                  ?>
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small fw-bold">Total</strong><span><?php echo $_SESSION['sum_total']."$"?></span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">Shipment Company</strong><span class="text-muted small"><?php echo $com?></span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">Estimated Arrival Time</strong><span class="text-muted small"><?php echo $time?></span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">Payment Type</strong><span class="text-muted small"><?php echo $payment_type?></span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><a href="index.php "class="small fw-bold">Return to Website</a>
                    <li class="border-bottom my-2"></li>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="bg-dark text-white">
        <div class="container py-4">
          <div class="row py-5">
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Customer services</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#!">Help &amp; Contact Us</a></li>
                <li><a class="footer-link" href="#!">Returns &amp; Refunds</a></li>
                <li><a class="footer-link" href="#!">Online Stores</a></li>
                <li><a class="footer-link" href="#!">Terms &amp; Conditions</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Company</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#!">What We Do</a></li>
                <li><a class="footer-link" href="#!">Available Services</a></li>
                <li><a class="footer-link" href="#!">Latest Posts</a></li>
                <li><a class="footer-link" href="#!">FAQs</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h6 class="text-uppercase mb-3">Social media</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#!">Twitter</a></li>
                <li><a class="footer-link" href="#!">Instagram</a></li>
                <li><a class="footer-link" href="#!">Tumblr</a></li>
                <li><a class="footer-link" href="#!">Pinterest</a></li>
              </ul>
            </div>
          </div>
          <div class="border-top pt-4" style="border-color: #1d1d1d !important">
            <div class="row">
              <div class="col-md-6 text-center text-md-start">
                <p class="small text-muted mb-0">&copy; 2021 All rights reserved.</p>
              </div>
              <div class="col-md-6 text-center text-md-end">
                <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor" href="https://bootstrapious.com/p/boutique-bootstrap-e-commerce-template">Bootstrapious</a></p>
                <!-- If you want to remove the backlink, please purchase the Attribution-Free License. See details in readme.txt or license.txt. Thanks!-->
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- JavaScript files-->
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/glightbox/js/glightbox.min.js"></script>
      <script src="vendor/nouislider/nouislider.min.js"></script>
      <script src="vendor/swiper/swiper-bundle.min.js"></script>
      <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
      <script src="js/front.js"></script>
      <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {
        
            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
        
      </script>
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
</html>
<?php
$query = $mysqli->prepare("DELETE FROM carts_contains_products WHERE carts_id= '$cart_id'");
$query->execute();
?>