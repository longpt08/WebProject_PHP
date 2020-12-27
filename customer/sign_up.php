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
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $number = $_POST['number'];
    $address = $_POST['address'];

    $query = "select * from customers where customer_email='$email'";
    $run_customer = mysqli_query($conn, $query);
    $is_exist = mysqli_num_rows($run_customer);
    if($is_exist==0){
        $insert = "insert into customers(customer_name, customer_email, customer_pass, customer_contact, customer_address) values ('$name', '$email', '$pass', '$number', '$address')";
        $result = mysqli_query($conn, $insert);
    }
    else $result = 0;

    // $get_ip = getRealIpUser();

    // $select_cart = "select * from cart where ip_add='$get_ip'";
    // $run_cart = mysqli_query($conn, $select_cart);
    // $check_cart = mysqli_num_rows($run_cart);

    $res = [];
    $res['result'] = $result;
    $_SESSION['customer_email'] = $email;
    echo json_encode($res);
?>