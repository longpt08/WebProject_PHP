<?php
$active = 'Giỏ hàng';
include("includes/database.php");
?>

<?php
if (isset($_GET["pro_id"]) && isset($_GET["qty"])) {
    global $conn;
    $qty = $_GET["qty"];
    $pro_id = $_GET["pro_id"];
    $get_products = "update cart set qty=" . $qty . " where p_id='" . $pro_id . "'";
    $run_products = mysqli_query($conn, $get_products);

    if ($run_products) {
        echo "<script>window.open('giohang.php','_self')</script>";
    }
}
?>