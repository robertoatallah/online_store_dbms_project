<?php
session_start();
$_SESSION["user_id"] = null;
?>
<html>
<head>
    <link href="css/styles.css" rel="stylesheet" />
    
</head>
<body>
    <section class="vh-100" style="background-color: #646464;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 0rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="images/login.jpg"
                      alt="login form" class="img-fluid" style="border-radius: 0rem 0 0 0rem;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                      <form method="POST" action="find_user.php">
      
                        <div class="d-flex align-items-center mb-3 pb-1">
                          <span class="h1 fw-bold mb-0">La Boutique Beirut</span>
                        </div>
      
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
      
                        <div class="form-outline mb-4">
                          <input type="email" id="form2Example17" name="email" class="form-control form-control-lg" required />
                          <label class="form-label" for="form2Example17">Email address</label>
                        </div>
      
                        <div class="form-outline mb-4">
                          <input type="password" id="form2Example27" name = "password" class="form-control form-control-lg" required/>
                          <label class="form-label" for="form2Example27">Password</label>
                        </div>
                        <?php
                          if(isset($_SESSION["error"])){
                            $error = $_SESSION["error"];
                            echo "<span style=\"color:red\">$error</span>";
                          }
                        ?>  
                        <div class="pt-1 mb-4">
                          <button class="btn btn-dark btn-lg btn-block" type="submit" name="submit">Login</button>
                        </div>
                        
                        
      
                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="signup.php"
                            style="color: #393f81;">Register here</a></p>

                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>

</html>
<?php
    unset($_SESSION["error"]);
?>