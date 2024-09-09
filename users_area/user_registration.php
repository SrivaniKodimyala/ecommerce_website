<?php
include('../Includes/connect.php');
include('../functions/common_function.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_register'])) {
    $username = $_POST['user_username'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $conf_password = $_POST['conf_user_password'];
    $address = $_POST['user_address'];
    $contact = $_POST['user_contact'];
    $image = $_FILES['user_image']['name'];
    $image_tmp = $_FILES['user_image']['tmp_name'];

    // Check if passwords match
    if ($password !== $conf_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if the username or email already exists
        $select_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = mysqli_query($con, $select_query);
        $row_count = mysqli_num_rows($result);

        if ($row_count > 0) {
            echo "<script>alert('Username or Email already exists!');</script>";
        } else {
            // Move uploaded image to the images folder
            move_uploaded_file($image_tmp, "user_images/$image");

            // Insert user into the database
            $insert_query = "INSERT INTO users (username, email, password, image, address, contact) VALUES ('$username', '$email', '$hashed_password', '$image', '$address', '$contact')";
            $execute_query = mysqli_query($con, $insert_query);

            if ($execute_query) {
                echo "<script>alert('Registration successful!');</script>";
                $_SESSION['username'] = $username;
                header('Location: ../index.php');
            } else {
                echo "<script>alert('Registration failed! Please try again.');</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-registration</title>
     <!--bootstrap CSS link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!--username field-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                    </div>
                    <!--email field-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email"/>
                    </div>
                    <!--image field-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image"/>
                    </div>
                    <!--password field-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                    </div>
                    <!--confirm password field-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Confirm password" autocomplete="off" required="required" name="conf_user_password"/>
                    </div>
                    <!--Address field-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address"/>
                    </div>
                    <!--Contact field-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your contact number" autocomplete="off" required="required" name="user_contact"/>
                    </div>
                    <!--submit button-->
                    <div class="mt-4 pt-2 w-50 m-auto">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account?<a href="user_login.php" class="text-danger"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>
</div>




    <!--bootstrap JS link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html> 
