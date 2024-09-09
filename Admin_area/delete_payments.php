<?php 
if(isset($_GET['delete_payment'])) {
    $delete_payment = intval($_GET['delete_payment']);
    echo $delete_payment; 
    $delete_query="Delete from `user_payments` where order_id=$delete_payment";
    $result=mysqli_query($con,$delete_query);
    if($result)
    {
        echo "<script>alert('payment deleted successfully')</script>";
        echo "<script>window.open('./index.php?delete_payment','_self')</script>";
    }
    
   
}
?>
