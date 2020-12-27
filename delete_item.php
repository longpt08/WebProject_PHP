<?php
$active = 'Giỏ hàng';
include("includes/database.php");
?>

<?php
if (isset($_GET["pro_id"])) {
    global $conn;
    $pro_id = $_GET["pro_id"];
    $get_products = "delete from cart where p_id=" . $pro_id;
    $run_products = mysqli_query($conn, $get_products);

    if ($run_products) {
        echo "<script>window.open('giohang.php','_self')</script>";
    }
}
?>