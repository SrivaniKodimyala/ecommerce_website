<?php
include('../Includes/connect.php');
include('../functions/common_function.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
     <style>
        body{
            overflow: hidden;
        }
     </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/registration.avif" alt="Admin Registration"
                class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
              <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username"
                     placeholder="Enter your name" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email"
                     placeholder="Enter your email" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password"
                     placeholder="Enter your password" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                     placeholder="Enter your  password again" required="required" class="form-control">
                </div>
                <div>
                    <input type="submit" class="bg-info py-2 px-3 border-0"
                    name="admin_registartion" value="Register">
                    <p class="small fw-bold mt-2 pt-1">Do you have account ?<a href="admin_login.php" class="link-success">Login</a></p>
                </div>

              </form>
            </div>

            
        </div>
    </div>
</body>
</html>

<!--php code -->

<?php
if(isset($_POST['admin_registartion'])){
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password=password_hash($password,PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];
    
    // Select Query
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$user_name' OR admin_email='$email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if($rows_count > 0) {
        echo "<script>alert('Username or Email already exist, please enter a proper one.')</script>";
    } elseif($password != $confirm_password) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password) VALUES ('$user_name', '$email', '$hash_password')";
        $sql_execute = mysqli_query($con, $insert_query);
        if($sql_execute) {
            echo "<script>alert('Registration successful')</script>";
        } else {
            echo "<script>alert('Error in registration')</script>";
        }
    }
}
?>
