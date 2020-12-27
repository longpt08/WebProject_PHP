<?php

session_start();

include("includes/database.php");
include("functions/functions.php");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap-337.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <script src="js/jquery-331.js"></script>
    <title>My Website</title>
    <!--login style-->
    <style>
        body {
            font-family: 'Varela Round', sans-serif;

        }

        .modal-login {
            color: #636363;
            width: 350px;
            margin: 30px auto;
        }

        .modal-login .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }

        .modal-login .modal-header {
            border-bottom: none;
            position: relative;
            justify-content: center;
        }

        .modal-login h4 {
            text-align: center;
            font-size: 26px;
        }

        .modal-login .form-group {
            position: relative;
        }

        .modal-login i {
            position: absolute;
            left: 13px;
            top: 11px;
            font-size: 18px;
        }

        .modal-login .form-control {
            padding-left: 40px;
        }

        .modal-login .form-control:focus {
            border-color: #00ce81;
        }

        .modal-login .form-control,
        .modal-login .btn {
            min-height: 40px;
            border-radius: 3px;
        }

        .modal-login .hint-text {
            text-align: center;
            padding-top: 10px;
        }

        .modal-login .close {
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .modal-login .btn {
            background: #00ce81;
            border: none;
            line-height: normal;
        }

        .modal-login .btn:hover,
        .modal-login .btn:focus {
            background: #00bf78;
        }

        .modal-login .modal-footer {
            background: #ecf0f1;
            border-color: #dee4e7;
            text-align: center;
            margin: 0 -20px -20px;
            border-radius: 5px;
            font-size: 13px;
            justify-content: center;
        }

        .modal-login .modal-footer a {
            color: #999;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <!-- Popper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->

    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</head>

<body>
    <script>
        $(document).ready(function() {

            //login event
            $("#btn_login").click(function() {
                var email = $("#email").val();
                var password = $("#password").val();
                const data = {
                    'email': email,
                    'password': password
                }
                $.ajax({
                    type: "POST",
                    url: "customer/customer_login.php",
                    data: data,
                    dataType: 'JSON'
                }).then(
                    //success
                    function(res) {

                        if (res.ck_cus > 0) {
                            var s = " <li><a href='logout.php'>Đăng xuất</a></li> "
                            $(".menu").empty()
                            $(".menu").html(s);
                            $("#loginframe").modal("hide")
                        } else {
                            $("#alert").text("Sai email hoặc mật khẩu")
                            $("#alert").addClass("bg-danger")
                        }
                    },
                    //fail
                    function() {
                        alert("Lỗi")
                    }
                )
            })

            //check pass
            $("#sign-up-confirm-password").blur(function() {
                var pass = $("#sign-up-password").val()
                var cpass = $("#sign-up-confirm-password").val()
                if (pass != cpass) {
                    $("#check").text("Không trùng khớp")
                    $("#check").addClass("bg-danger")
                } else {
                    $("#check").removeClass("bg-danger")
                    $("#check").text("Trùng khớp")
                    $("#check").addClass("bg-success")
                }
            })

            //sign up button catch event
            $("#button-sign-up").click(function() {
                var email = $("#sign-up-email").val()
                var password = $("#sign-up-password").val()
                var name = $("#sign-up-name").val()
                var date = $("#sign-up-date").val()
                var number = $("#sign-up-number").val()
                var address = $("#sign-up-address").val()
                const data = {
                    'email': email,
                    'password': password,
                    'name': name,
                    'date': date,
                    'number': number,
                    'address': address
                }
                console.log(data)
                $.ajax({
                    type: 'POST',
                    url: "customer/sign_up.php",
                    data: data,
                    dataType: 'JSON'
                }).then(function(res) {
                    if (res.result == 1) {
                        var s = " <li><a href='logout.php'>Đăng xuất</a></li> "
                        $(".menu").empty()
                        $(".menu").html(s);
                        $("#signupframe").modal("hide")
                        $("#welcome").html("Chào mừng: " + $_SESSION['customer_email'])
                    } else {
                        $("#alert").hmtl("Email đã đăng kí")
                    }
                }, function() {
                    alert("Lỗi")
                })
            })
        })
    </script>
    <!-- Bat dau Top-->
    <div id="top">
        <div class="container">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <ul class="menu">
                    <?php
                    if (!isset($_SESSION['customer_email'])) {
                        echo "
                        <li>
                        <button type='button' class='btn' data-toggle='modal' data-target='#signupframe'>Đăng Ký</button>
                        </li>
                        <li>
                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#loginframe'>Đăng Nhập</button>
                        </li>
                        ";
                    } else {
                        echo "
                            <li>
                                <a href='my_account.php' id='welcome' class='btn btn-success btn-sm'>Chào mừng: " . $_SESSION['customer_email']."</a>

                            </li>
                            <li>
                                <a href='logout.php'>Đăng xuất</a>
                            </li>
                        ";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <!--Ket thuc Top-->
    <!--Bat dau Header-->
    <div id="navbar" class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a href="../index.php" class="navbar-brand home">
                    <img style="width:125px;height:49px;" src="images/logo.jpg" alt="Lixibox Logo" class=hidden-xs>
                    <img style="width:83px;height:33px;" src="images/logo.jpg" alt="Lixibox Logo Mobile"
                        class="visible-xs">
                </a>
                <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle Navigation</span>
                    <i class="fa fa-align-justify"></i>
                </button>
                <button class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle Search</span>
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="navigation">
                <div class="padding-nav">
                    <ul class="nav navbar-nav left">
                        <li class="<?php if ($active == 'Trang chủ') echo "active"; ?>">
                            <a href="../index.php">Trang chủ</a>
                        </li>

                        <li class="<?php if ($active == 'Cửa hàng') echo "active"; ?>">
                            <a href="../cuahang.php">Cửa hàng</a>
                        </li>
                        <li class="<?php if ($active == 'Giỏ hàng') echo "active"; ?>">
                            <a href="../giohang.php">Giỏ hàng</a>
                        </li>

                        <li class="<?php if ($active == 'Liên hệ chúng tôi') echo "active"; ?>">
                            <a href="../lienhe.php">Liên hệ chúng tôi</a>
                        </li>

                    </ul>
                </div>

                <a href="../giohang.php" class="btn navbar-btn btn-primary right">
                    <i class="fa fa-shopping-cart"></i>
                    <span><?php items(); ?> sản phẩm trong giỏ hàng</span>
                </a>
                <div class="navbar-collapse collapse right">
                    <button class="btn btn-primary navbar-btn" type="button" data-toggle="collapse"
                        data-target="#search">
                        <span class="sr-only">Toggle Search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

                <?php
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
                $searchS = $_POST['search'];
                ?>

                <div class="collapse clearfix" id="search">
                    <form method="get" action="search.php?search=<?php echo $searchS; ?>" class="navbar-form">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập tìm kiếm" name="search" required>
                            <span class="input-group-btn">
                                <button type="submit" name="ok" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Ket thuc Header-->

    <!--Login frame-->
    <div id="loginframe" class="modal fade">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Member Login</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <input id="email" type="text" class="form-control" placeholder="Email" name="email" required="required">
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input id="password" type="password" class="form-control" placeholder="Mật khẩu" name="password" required="required">
                    </div>

                    <div>
                        <p id="alert"></p>
                    </div>

                    <div class="form-group">
                        <button id="btn_login" type="button" class="btn btn-primary btn-block btn-lg" value="login">Đăng nhập</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>


    <!--Sign up frame-->
    <div id="signupframe" class="modal fade">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đăng ký</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <input id="sign-up-email" type="text" class="form-control" placeholder="Email" name="email" required="required">
                    </div>

                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input id="sign-up-password" type="password" class="form-control" placeholder="Mật khẩu" name="password" required="required">
                    </div>

                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input id="sign-up-confirm-password" type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="cpassword" required="required">
                    </div>
                    <p id="check"></p>
                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <input id="sign-up-name" type="text" class="form-control" placeholder="Tên" name="name" required="required">
                    </div>

                    <div class="form-group">
                        <i class="fa fa-calendar"></i>
                        <input id="sign-up-date" type="text" class="form-control" placeholder="Ngày sinh" name="date" required="required">
                    </div>

                    <div class="form-group">
                        <i class="fa fa-phone"></i>
                        <input id="sign-up-number" type="text" class="form-control" placeholder="SĐT" name="number" required="required">
                    </div>


                    <div class="form-group">
                        <i class="fa fa-home"></i>
                        <input id="sign-up-address" type="text" class="form-control" placeholder="Địa chỉ" name="address" required="required">
                    </div>

                    <div class="form-group">
                        <button id="button-sign-up" type="button" class="btn btn-primary btn-block btn-lg" value="signup">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    if (isset($_REQUEST['ok'])) {
        $search = addslashes($_GET['search']);
    }

    ?>
