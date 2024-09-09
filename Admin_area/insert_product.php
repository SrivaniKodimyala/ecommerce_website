<?php
include('../Includes/connect.php');
if(isset($_POST['insert_product'])){
$product_title=$_POST['product_title'];
$description=$_POST['description'];
$product_Keywords=$_POST['product_Keywords'];
$product_category=$_POST['product_category'];
$product_brands=$_POST['product_brands'];
$product_price=$_POST['product_price'];
$product_status='true';

//acessing images
$product_image1=$_FILES['product_image1']['name'];
$product_image2=$_FILES['product_image2']['name'];
$product_image3=$_FILES['product_image3']['name'];

//accessing temp name
$temp_image1=$_FILES['product_image1']['tmp_name'];
$temp_image2=$_FILES['product_image2']['tmp_name'];
$temp_image3=$_FILES['product_image3']['tmp_name'];

//checking empty conditions
if($product_title=='' or $description=='' or $product_Keywords=='' or $product_category=='' or $product_brands=='' or $product_price==''
 or $product_image1=='' or $product_image2=='' or $product_image3=='')
{
    echo"<script>alert('please fill all the available fields')</script>";
    exit();
}
else{
    move_uploaded_file($temp_image1,"./product_images/$product_image1");
    move_uploaded_file($temp_image2,"./product_images/$product_image2");
    move_uploaded_file($temp_image3,"./product_images/$product_image3");

    //insert query
    $insert_products = "INSERT INTO `products` (
        product_title, product_description, product_keywords, category_id, brand_id, 
        product_image1, product_image2, product_image3, product_price, date, status
    ) VALUES (
        '$product_title', '$description', '$product_Keywords', '$product_category', '$product_brands', 
        '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status'
    )";
    
    $result_query = mysqli_query($con, $insert_products);
     if($result_query)
     {
        echo"<script>alert('Successfully inserted the products')</script>";
     }
}



}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <!--bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!--css file link-->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!--forms-->
        <form action="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="from-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="enter product title" autocomplete="off" required="required">
            </div>
            <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="from-label">Product Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="enter product descriprion" autocomplete="off" required="required">
            </div>
             <!--Keywords-->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_Keywords" class="from-label">product Keyword</label>
                <input type="text" name="product_Keywords" id="product_Keywords" class="form-control" placeholder="enter product_Keywords" autocomplete="off" required="required">
            </div>
            <!--categories-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select Category</option>
                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while($row=mysqli_fetch_assoc( $result_query)){
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";

                    }
                    
                    ?>
                 
                   
                </select>
            </div>

            <!--brands-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id="" class="form-select">
                <option value="">Select Brand</option>
                <?php
                    $select_query = "SELECT * FROM `brands`";
                    $result_query = mysqli_query($con, $select_query);
                    while($row=mysqli_fetch_assoc( $result_query)){
                        $brand_title=$row['brand_tittle'];
                        $brand_id=$row['brand_id'];
                        echo "<option value=' $brand_id'>$brand_title</option>";

                    }
                    
                    ?>
                </select>
            </div>

            <!--Image1-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="from-label">product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control"  required="required">
            </div>


            <!--Image2-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="from-label">product image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control"  required="required">
            </div>

              <!--Image3-->
              <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="from-label">product image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control"  required="required">
            </div>
            
            <!--pricing-->
             
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="from-label">product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="enter product_price" autocomplete="off" required="required">
            </div>

            <!--pricing-->
             
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Product">
            </div>
        </form>

    </div>
</body>
</html>