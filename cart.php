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
    <title>Ecommerce Website - Cart Details</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS file link -->
    <link rel="stylesheet" href="style.css">
    <style>
        .cart_img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        a {
            text-decoration: none;
        }
    </style>
    <script>
        function validateQuantity() {
    const quantityInputs = document.querySelectorAll('input[name^="qty"]');
    let valid = true;

    quantityInputs.forEach(input => {
        const value = parseInt(input.value, 10);
        if (isNaN(value) || value <= 0) {
            alert('Please enter a valid positive quantity.');
            valid = false;
        }
    });

    return valid;
}

    </script>
</head>
<body>
    <!-- Navbar -->
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
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Calling cart function -->
    <?php
    cart();
    ?>

    <!-- Second Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
        <?php
        //for guest
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
        //for login
        if(!isset($_SESSION['username']))
        {
            echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_login.php'>Login</a>
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

    <!-- Third Child -->
    <div class="bg-light">
        <h3 class="text-center">Kavya Store</h3>
        <p class="text-center">Communication is at the heart of e-commerce and community</p>
    </div>

    <!-- Cart Table -->
    <div class="container">
        <form action="" method="post" onsubmit="return validateQuantity();">
            <div class="row">
                <?php
                $get_ip_add = getIPAddress();
                $total_price = 0;
                $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
                $result = mysqli_query($con, $cart_query);
                $cart_count = mysqli_num_rows($result);

                if ($cart_count > 0) {
                    echo '
                    <h3 class="text-center my-4">Your Cart</h3>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                    
                    while ($row = mysqli_fetch_array($result)) {
                        $product_id = $row['product_id'];
                        $quantity = $row['quantity']; // Retrieve the current quantity
                        $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
                        $result_products = mysqli_query($con, $select_products);
                        
                        while ($row_product_price = mysqli_fetch_array($result_products)) {
                            $product_price = $row_product_price['product_price'];
                            $product_title = $row_product_price['product_title'];
                            $product_image1 = $row_product_price['product_image1'];
                            $total_price += $product_price * $quantity; // Calculate the total price for the product based on quantity
                ?>
                        <tr>
                            <td><?php echo $product_title; ?></td>
                            <td><img src="./Admin_area/product_images/<?php echo $product_image1; ?>" alt="" class="cart_img"></td>
                            <td>
                                <input type="number" name="qty[<?php echo $product_id; ?>]" class="form-input w-50" value="<?php echo $quantity; ?>">
                            </td>
                            <td><?php echo $product_price * $quantity; ?>/-</td>
                            <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>"></td>
                            <td>
                                <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                                <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                            </td>
                        </tr>
                <?php
                        }
                    }
                    echo '
                        </tbody>
                    </table>
                    <div class="d-flex mb-3">
                        <h4 class="px-3">Subtotal: <strong class="text-info">' . $total_price . '/-</strong></h4>
                        <a href="index.php" class="bg-info px-3 py-2 border-0 mx-3 text-decoration-none text-dark">Continue Shopping</a>
                        <a href="./users_area/newcheckout.php" class="bg-secondary px-3 py-2 border-0 text-light text-decoration-none">Buy Now</a>
                    </div>';
                } else {
                    echo '<h4 class="text-center my-4">Your cart is empty.</h4>
                     <div class="d-flex mb-3">
                        <a href="index.php" class="bg-info px-3 py-2 border-0 mx-3 text-decoration-none text-dark">Continue Shopping</a>
                    </div>';
                }
                ?>
            </div> 
        </form>
    </div>

    <!-- Function to handle cart updates -->
    <?php
    function update_cart() {
        global $con;
        if (isset($_POST['update_cart'])) {
            foreach ($_POST['qty'] as $product_id => $quantity) {
                $quantity = intval($quantity);
                if ($quantity > 0) {
                    $update_cart = "UPDATE `cart_details` SET quantity = $quantity WHERE ip_address = '" . getIPAddress() . "' AND product_id = $product_id";
                    $result_products_quantity = mysqli_query($con, $update_cart);
                    if (!$result_products_quantity) {
                        die('Error: ' . mysqli_error($con));
                    }
                } else {
                    echo "<script>alert('Invalid quantity. Please enter a positive value.');</script>";
                    echo "<script>window.location='cart.php';</script>";
                    return;
                }
            }
            echo "<script>alert('Cart updated successfully.');</script>";
            echo "<script>window.location='cart.php';</script>";
        }
    }

    function remove_cart_item() {
        global $con;
        if (isset($_POST['remove_cart'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
                $run_delete = mysqli_query($con, $delete_query);
                if ($run_delete) {
                    echo "<script>alert('Item removed from cart.');</script>";
                    echo "<script>window.location='cart.php';</script>";
                }
            }
        }
    }

    // Call the functions
    update_cart();
    remove_cart_item();
    ?>

    <!-- Include footer -->
    <?php include("./Includes/footer.php"); ?>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy" crossorigin="anonymous"></script>
</body>
</html>
