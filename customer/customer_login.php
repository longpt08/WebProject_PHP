<?php
    include("includes/database.php");
    session_start();
    function getRealIpUser()
{

    switch (true) {

        case (!empty($_SERVER['HTTP_X_REAL_IP'])):
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])):
            return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default:
            return $_SERVER['REMOTE_ADDR'];
    }
}

// if (isset($_POST['login'])) {
    $customer_email = $_POST['email'];
    $customer_pass = $_POST['password'];

    $query = "select * from customers where customer_email='$customer_email' and customer_pass='$customer_pass'";
    $run_customer = mysqli_query($conn, $query);
    $check_customer = mysqli_num_rows($run_customer);

    // $get_ip = getRealIpUser();

    // $select_cart = "select * from cart where ip_add='$get_ip'";
    // $run_cart = mysqli_query($conn, $select_cart);
    // $check_cart = mysqli_num_rows($run_cart);

    $res = [];
    $res['ck_cus'] = $check_customer;
    $_SESSION['customer_email'] = $customer_email;
    // $res['ck_cart'] = $check_cart;
    echo json_encode($res);
    // echo json_encode("true");
// }

    // echo $check_customer;
    // echo $check_cart;

    /*if ($check_customer == 0) {
        echo "<script>('Email hoặc mật khẩu không đúng')</script>";
        exit();
    }
    if ($check_customer == 1 && $check_cart == 0) {
        $_SESSION['customer_email'] = $customer_email;
        echo "<script>alert('Đăng nhập thành công')</script>";
        echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
    } else {
        $_SESSION['customer_email'] = $customer_email;
        echo "<script>alert('Đăng nhập thành công')</script>";
        echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
    }
    */

?>