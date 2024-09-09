<?php
include('../Includes/connect.php');
include('../functions/common_function.php');
@session_start();
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
        <h2 class="text-center mb-5">Admin Login</h2>
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password"
                     placeholder="Enter your password" required="required" class="form-control">
                </div>
                <div>
                    <input type="submit" class="bg-info py-2 px-3 border-0"
                    name="admin_login" value="Login">
                    <p class="small fw-bold mt-2 pt-1">Don't you have account ?<a href="admin_registration.php" class="link-success">Register</a></p>
                </div>

              </form>
            </div>

            
        </div>
    </div>
</body>
</html>

<?php


if(isset($_POST['admin_login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database query to select the admin record by username
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name = '$username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);

    // Check if the user exists
    if($row_count > 0)
    {
        $row_data = mysqli_fetch_assoc($result);
        
        // Verify the password
        if(password_verify($password, $row_data['admin_password']))
        {
            // Set session variables
            $_SESSION['username'] = $username;

            // Successful login
            echo "<script>alert('Login successful');</script>";
            echo "<script>window.open('./index.php', '_self');</script>";
        }
        else
        {
            // Password incorrect
            echo "<script>alert('Invalid password');</script>";
            echo "<script>window.open('user_login.php', '_self');</script>";
        }
    }
    else
    {
        // Username not found
        echo "<script>alert('Username not found');</script>";
        echo "<script>window.open('./user_login.php', '_self');</script>";
    }
}
?>
