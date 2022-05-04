<?php
session_start();
?>
<html>

    <head>
        <link href="css/styles.css" rel="stylesheet" />
        <style>
            .background-radial-gradient {
              background-color: hsl(218, 41%, 15%);
              background-image: radial-gradient(650px circle at 0% 0%,
                  hsl(218, 41%, 35%) 15%,
                  hsl(218, 41%, 30%) 35%,
                  hsl(218, 41%, 20%) 75%,
                  hsl(218, 41%, 19%) 80%,
                  transparent 100%),
                radial-gradient(1250px circle at 100% 100%,
                  hsl(218, 41%, 45%) 15%,
                  hsl(218, 41%, 30%) 35%,
                  hsl(218, 41%, 20%) 75%,
                  hsl(218, 41%, 19%) 80%,
                  transparent 100%);
            }
        
            #radius-shape-1 {
              height: 220px;
              width: 220px;
              top: -60px;
              left: -130px;
              background: radial-gradient(#44006b, #ad1fff);
              overflow: hidden;
            }
        
            #radius-shape-2 {
              border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
              bottom: -60px;
              right: -110px;
              width: 300px;
              height: 300px;
              background: radial-gradient(#44006b, #ad1fff);
              overflow: hidden;
            }
        
            .bg-glass {
              background-color: hsla(0, 0%, 100%, 0.9) !important;
              backdrop-filter: saturate(200%) blur(25px);
            }
          </style>
    </head>
    <body>
        <!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden">


  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
          The best deals <br />
          <span style="color: hsl(218, 81%, 75%)">For your Second Hand Clothes</span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
          The Thrift Shop is a Lebanon based online store that provide you with high-quality second hand clothes at competitive prices.
          As one of the few online resale platforms in Lebanon for women’s and kids’ apparel, shoes, and accessories, our mission is to inspire
           a new generation of shoppers to think secondhand clothes first. You can shop like-new and used women’s clothes and kids’ clothes at up 
           to 90% off estimated retail at our online thrift store and consignment shop. From Gap to Gucci, we have all your favorite brands
            (including H&ampM, Zara, Mango & more!) for less. Plus, enjoy thousands of arrivals every day. Happy thrifting!
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
            
        <div class="card bg-glass">
          <div class="card-body px-4 py-5 px-md-5">
            <form id="contactForm" action="add_user.php" method="POST">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="first_name" name="first_name" class="form-control" required/>
                    <label class="form-label" for="first_name">First name</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="last_name" name="last_name" class="form-control" required/>
                    <label class="form-label" for="last_name">Last name</label>
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com" required/>
                <label class="form-label" for="email">Email address</label>
              </div>

              <!-- Gender input -->
              <div class ="form-outline mb-4">
                  <h5>Choose your gender:</h5>
                  <input type="radio" name="gender" id="male" value="male"> Male<br>
                  <input type="radio" name="gender" id="female" value="female" > Female<br>
                  <input type="radio" name="gender" id="other" value="other" > Other<br>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="pass" name="pass" class="form-control" required />
                <label class="form-label" for="pass">Password</label>
              </div>

              <!-- Date of Birth input -->
              <div class="form-outline mb-4">
                <input type="date" id="dob" name="dob" class="form-control"  name="dateofB" required
                    value="2022-04-28"
                    min="1900-01-01" max="2022-04-28">
                <label class="form-label" for="dob">Date of Birth</label>
            </div>

            <!-- Phone Number input -->
            <div class="form-outline mb-4">
                <input type="tel" id="phone" name="phone" class="form-control"  placeholder="(961) 03 123 456" required />
                <label class="form-label" for="phone">Phone Number</label>
              </div>
              <!-- Error if email already exists -->
              <?php
                if(isset($_SESSION["error"])){
                  $error = $_SESSION["error"];
                  echo "<span style=\"color:red\">$error</span>";
                  }
              ?>  
          
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4" name="submit">
                Sign up
              </button>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
    </body>

</html>
<?php
    unset($_SESSION["error"]);
?>