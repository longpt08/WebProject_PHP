<?php
    include("../includes/database.php");
    include("includes/header.php");
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = "";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap-337.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <script src="js/myjquery.js"></script>
    <title>My Website</title>
</head>

<body>
    <!--Bat dau content cua san pham-->
    <div id="content">
        <div class="container">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="index.php">Trang chủ</a>
                    </li>
                    <li>
                        Tài khoản của tôi
                    </li>
                </ul>
            </div>

            <div class="col-md-3">
                <?php
                    include("includes/sidebar.php");
                    ?>
            </div>

            <div class="col-md-9">
                <div class="box">
                    <?php
                        switch($page){
                            case "pay_offline": include("pay_offline.php"); break;
                            case "edit_account": include("edit_account.php"); break;
                            case "change_pass": include("change_pass.php"); break;
                            case "delete_account": include("delete_account.php"); break;
                            default: include("my_orders.php");
                        }
                        ?>

                    <?php
                        if (isset($_GET['delete_account'])) {
                            include("delete_account.php");
                        }
                        ?>
                    <?php
                        if (isset($_GET['logout'])) {
                            include("logout.php");
                        }
                        ?>

                </div>
            </div>
        </div>
    </div>
    <?php

        include("includes/footer.php");
        ?>


    <script src="js/jquery-331.js"></script>
    <script src="js/boostrap-337.js"></script>
</body>

</html>