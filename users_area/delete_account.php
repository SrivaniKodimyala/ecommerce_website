<h3 class="text-danger nb-4">Delete Account</h3>
<form action="" method="post" class="mt-5">
    <div class="form-outline mb-4">
        <!-- Button to permanently delete the account -->
        <input type="submit" class="form-control w-50 m-auto bg-danger" name="delete_permanently" value="Delete Permanently">
    </div>
    <div class="form-outline mb-4">
        <!-- Button to temporarily delete and store data in the deleted_users table -->
        <input type="submit" class="form-control w-50 m-auto bg-warning" name="restore_and_delete" value="Restore and Delete">
    </div>
    <div class="form-outline mb-4">
        <!-- Button to cancel the deletion -->
        <input type="submit" class="form-control w-50 m-auto bg-success" name="dont_delete" value="Don't Delete Account">
    </div>
</form>


<?php
$username_session = $_SESSION['username'];

// Handle permanent deletion
if(isset($_POST['delete_permanently'])) {
    // Delete the user permanently from user_table
    $delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
    $result = mysqli_query($con, $delete_query);
    if($result) {
        session_destroy(); // End the session
        echo "<script>alert('Account permanently deleted successfully');</script>";
        echo "<script>window.open('../index.php', '_self');</script>";
    } else {
        echo "<script>alert('Failed to delete the account permanently');</script>";
    }
}

// Handle temporary deletion and restore option
if(isset($_POST['restore_and_delete'])) {
    // Copy the user data to deleted_users table
    $copy_query = "INSERT INTO `deleted_users` (username, user_email,deleted_at)
                   SELECT username, user_email, deleted_at FROM `user_table` WHERE username='$username_session'";
    $copy_result = mysqli_query($con, $copy_query);

    if($copy_result) {
        // Delete the user from user_table after copying the data
        $delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
        $delete_result = mysqli_query($con, $delete_query);

        if($delete_result) {
            session_destroy(); // End the session
            echo "<script>alert('Account deleted successfully and data stored temporarily');</script>";
            echo "<script>window.open('../index.php', '_self');</script>";
        } else {
            echo "<script>alert('Failed to delete the account');</script>";
        }
    } else {
        echo "<script>alert('Failed to store data temporarily');</script>";
    }
}

// Handle canceling the deletion
if(isset($_POST['dont_delete'])) {
    echo "<script>window.open('profile.php', '_self');</script>";
}
?>

    
