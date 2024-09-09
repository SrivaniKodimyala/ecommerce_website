<!--connect field-->
<?php
include('includes/connect.php');
include('functions/common_function.php');

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerece website using PHP and MySQL</title>
    <!--bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!--css file link-->
    <link rel="stylesheet" href="style.css">
    <style>
      body{
        overflow-x: hidden;
      }
      .modal-container {
    background-color: rgba(0, 0, 0, 0.5);
    position: fixed; /* Ensure the modal is positioned relative to the viewport */
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display:none; /* Hide the modal by default */
    z-index: 1050; /* Ensure it is above other content */
}

.model-open {
    background-color: var(--fourth-color);
    width: 40.1rem;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 2rem;
    box-shadow: 0 0 2rem rgba(0, 0, 0, 0.5);
    z-index: 1060; /* Ensure it is above the container */
}


.modal-header {
    background-color: var(--second-color);
    color: var(--fourth-color);
    padding: 1rem;
    font-size: 1.4rem;
    margin-bottom: 2rem;
}

.modal-tag {
    text-align: center;
    font-size: 1.5rem;
}

.model-form div {
    margin: 1.8rem 0;
}

.form-label {
    display: block;
    margin-bottom: 5px;
    font-size: 1.5rem;
    font-weight: 500;
}

.form-input {
    padding: 0.8rem;
    width: 100%;
}

.close-btn {
    background-color: transparent;
    border: 0;
    position: absolute;
    top: 2.3rem;
    right: 2.5rem;
}

.close-icon {
    color: var(--fourth-color);
    font-size: 3rem;
}
:root {
    --first-color: #0dcaf0;
    --second-color: #6c757d;
    --third-color: #f4bf96;
    --fourth-color: #fcf5ed;
    
}
.model-container1{
    background-color: rgba(0, 0, 0, 0.5);
    position: fixed; /* Ensure the modal is positioned relative to the viewport */
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display:none; /* Hide the modal by default */
    z-index: 1050; /* Ensure it is above other content */
}

.close-btn1 {
    background-color: transparent;
    border: 0;
    position: absolute;
    top: 2.3rem;
    right: 2.5rem;
}
.model-open1 {
    background-color: var(--fourth-color);
    width: 25.1rem;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 1rem;
    box-shadow: 0 0 2rem rgba(0, 0, 0, 0.5);
    z-index: 1060; /* Ensure it is above the container */
}

    </style>
</head>
<body>
    <!--first child-->
    <!--navbar-->
    <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="./images/logo.jpg" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <?php
           if(isset($_SESSION['username']))
           {
            echo "<li class='nav-item'>
            <a class='nav-link' href='./users_area/profile.php'>My Account</a>
          </li>";
           }else{
            echo"<li class='nav-item'>
          <a class='nav-link' href='#' id='open'>Register</a>
        </li>";
           }
           
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total price: <?php total_cart_price();  ?>/--</a>
        </li>
      </ul>
      
  </div>
    <form class="d-flex" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
         <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
     </form>
  </div>
</div>
</nav>
    <!--calling cart function-->
    <?php
    cart();
    ?>

    <!--second child-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
        <?php
        if(!isset($_SESSION['username']))
        {
            echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
        }
        else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome  ".$_SESSION['username']."</a>
        </li>";
        }
        if(!isset($_SESSION['username']))
        {
            echo "<li class='nav-item'>
          <a class='nav-link' href='##' id='open1'>Login</a>
        </li>";
        }
        else{
          echo "<li class='nav-item'>
              <a class='nav-link' href='./users_area/logout.php'>Logout</a>
        </li>";
        }
        ?>
             
        </ul>
    </nav>

    <!--third child-->
    <div  class="bg-light">
        <h3 class="text-center">kavya Store</h3>
        <p class="text-center">Communication is at the heart of e-commerec and community</p>

    </div>

    <!--fourth child-->
    <div class="row px-1">
        <div class="col-md-10">
            <!--products-->
            <div class="row">
              <!--fetching products-->
              <?php
              //calling function
              getproducts();
              get_unique_categories();
              get_unique_brands();
              // $ip = getIPAddress();  
              // echo 'User Real IP Address - '.$ip;  
              ?>
              
<!--row end-->
            </div>
            <!--col end-->
        </div>
        <div class="col-md-2 bg-secondary p-0">
            <!--brands to be displayed-->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
                </li>
                <?php
                    
                    getbrands();
                ?>
              
            </ul>
            <!--categories to be displayed-->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
                </li>
                <?php
                   getcategories();
                ?>
            </ul>

        </div>

    </div>





    <!--form-->
    <?php
if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    // Check if user already exists by username or email
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    
    if($rows_count > 0) {
        $status = 'exists';
    } elseif($user_password != $conf_user_password) {
        $status = 'password_mismatch';
    } else {
        // Move uploaded file
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        
        // Insert query
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) 
                         VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
        
        $sql_execute = mysqli_query($con, $insert_query);
        
        //selecting cart items
        $select_cart_item = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $result_cart = mysqli_query($con, $select_cart_item);
        $rows_count = mysqli_num_rows($result_cart);

        if($rows_count > 0) {
            $_SESSION['username'] = $user_username;
            $status = 'cart_items';
        } else {
            $status = 'success';
        }
    }
}
?>

<div class="modal-container" id="model">
    <div class="model-open">
         <button class="close-btn" id="close">&times;</button>
        <h4 class="text-center">New User Registration</h4>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-10 col-xl-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Username field -->
                    <div class="form-outline mb-1">
                        <label for="user_username" class="form-label"><h6>Username</h6></label>
                        <input type="text" id="user_username" class="form-control form-control-sm" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                    </div>
                    <!-- Email field -->
                    <div class="form-outline mb-1">
                        <label for="user_email" class="form-label"><h6>Email</h6></label>
                        <input type="email" id="user_email" class="form-control form-control-sm" placeholder="Enter your email" autocomplete="off" required="required" name="user_email"/>
                    </div>
                    <!-- Image field -->
                    <div class="form-outline mb-1">
                        <label for="user_image" class="form-label"><h6>User Image</h6></label>
                        <input type="file" id="user_image" class="form-control form-control-sm" required="required" name="user_image"/>
                    </div>
                    <!-- Password field -->
                    <div class="form-outline mb-1">
                        <label for="user_password" class="form-label"><h6>Password</h6></label>
                        <input type="password" id="user_password" class="form-control form-control-sm" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                    </div>
                    <!-- Confirm password field -->
                    <div class="form-outline mb-1">
                        <label for="conf_user_password" class="form-label"><h6>Confirm Password</h6></label>
                        <input type="password" id="conf_user_password" class="form-control form-control-sm" placeholder="Confirm password" autocomplete="off" required="required" name="conf_user_password"/>
                    </div>
                    <!-- Address field -->
                    <div class="form-outline mb-1">
                        <label for="user_address" class="form-label"><h6>Address</h6></label>
                        <input type="text" id="user_address" class="form-control form-control-sm" placeholder="Enter your address" autocomplete="off" required="required" name="user_address"/>
                    </div>
                    <!-- Contact field -->
                    <div class="form-outline mb-1">
                        <label for="user_contact" class="form-label"><h6>Contact</h6></label>
                        <input type="text" id="user_contact" class="form-control form-control-sm" placeholder="Enter your contact number" autocomplete="off" required="required" name="user_contact"/>
                    </div>
                    <!-- Submit button -->
                    <div class="mt-3 pt-2 text-center">
                        <input type="submit" value="Register" class="bg-info py-1 px-2 border-0" name="user_register">
                        <p class="small fw-bold mt-2 mb-0">Already have an account? <a href="users_area/user_login.php" class="text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--user_login-->
<div class="model-container1" id="model1">
<div class="model-open1">
<button class="close-btn1" id="close1">&times;</button>
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex algin-item-center justify-content-center mt-5">
             <div class="col-lg-12 col-xl-6">
                 <form action="" method="post">
                     <!--username field-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control"  placeholder="enter your user" autocomplete="off" required="required" name="user_username"/>
                    </div>
                    <!--password field-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control"  placeholder="enter your password" autocomplete="off" required="required" name="user_password"/>
                    </div>
                       <div class="mt-4 pt-2 w-50 m-auto">
                              <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                              <p class="small fw-bold mt-2 pt-1 mb-3">Don't have an account?<a href="../index.php" class="text-danger">  Register</a></p>
                       </div>
                 </form>
             </div>
        </div>
</div>
    </div>

    <?php
    if(isset($_POST['user_login']))
    {
        $user_username=$_POST['user_username'];
        $user_password=$_POST['user_password'];

        $select_query="Select *from `user_table` where username='$user_username'";
        $result=mysqli_query($con, $select_query);
        $row_count=mysqli_num_rows($result);
        $row_data=mysqli_fetch_assoc($result);
        $user_ip=getIPAddress();
        //cart item
        $select_query_cart="Select *from `cart_details` where ip_address='$user_ip'";
        $select_cart=mysqli_query($con,$select_query_cart);
        $row_count_cart=mysqli_num_rows($select_cart);
        if($row_count>0)
        {
            $_SESSION['username']=$user_username;
          if(password_verify($user_password,$row_data['user_password'])){
            // echo "<script>alert('Login successful')</script>";
            if($row_count==1 and $row_count_cart==0)
            {
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('users_area/profile.php','_self')</script>";
            }else{
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('users_area/payment.php','_self')</script>";
            }
          }
          else{
            echo "<script>alert('Invalid Credentials')</script>";
          }
        }
        else{
            echo "<script>alert('user not existes with this name')</script>";
        }
        
    }
?>











<script>
    const openBtn = document.getElementById('open');
    const openBtn1 = document.getElementById('open1');
    const closeBtn = document.getElementById('close');
    const closeBtn1= document.getElementById('close1');
    const modal = document.getElementById('model');
    const modal1 = document.getElementById('model1');

    openBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });
    openBtn1.addEventListener('click', () => {
        modal1.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });
    closeBtn1.addEventListener('click', () => {
        modal1.style.display = 'none';
    });

    // Close modal when clicking outside of the modal
    window.addEventListener('click', (e) => {
        if (e.target === modal1) {
            modal1.style.display = 'none';
        }
    });
    window.addEventListener('click', (f) => {
        if (f.target === modal) {
            modal.style.display = 'none';
        }
    });

    function toggleForms() {
            var loginForm = document.getElementById('login-form');
            var registerForm = document.getElementById('register-form');
            if (loginForm.classList.contains('active')) {
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
            } else {
                registerForm.classList.remove('active');
                loginForm.classList.add('active');
            }
        }
</script>


<?php if (isset($status)): ?>
    document.addEventListener('DOMContentLoaded', (event) => {
        let status = '<?php echo $status; ?>';
        if (status === 'exists') {
            alert('User with this username or email already exists');
        } else if (status === 'password_mismatch') {
            alert('Confirm password does not match with password');
        } else if (status === 'cart_items') {
            alert('You have items in your cart');
            window.location.href = 'checkout.php';
        } else if (status === 'success') {
            alert('Registration successful');
            window.location.href = 'users_area/user_login.php';
        }
    });
<?php endif; ?>
</script>





<!--last child-->
<!--include footer-->
   <?php
      include("./Includes/footer.php")
   ?>
<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>