<?php
include('../Includes/connect.php');

if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];
    // Select data from database
    $select_query = "SELECT * FROM `categories` WHERE category_title='$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('This category is already present in the database');</script>";
    } else {
        $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
        $result = mysqli_query($con, $insert_query);

        if ($result) {
            echo "<script>alert('Category has been inserted successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        }
    }
}
?>



<h2 class="text-center">Insert Categories</h2>

<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="Categories" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 m-auito">

  
   <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="insert categories">
</div>
</form>