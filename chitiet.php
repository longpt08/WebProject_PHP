<?php
$active = 'Giỏ hàng';

include("includes/database.php");
include("includes/header.php");
?>

<?php
if (isset($_GET['pro_id'])) {
    $product_id = $_GET['pro_id'];

    $get_product = "select * from products where product_id='$product_id'";
    $run_product = mysqli_query($conn, $get_product);
    $row_product = mysqli_fetch_array($run_product);

    $p_cat_id = $row_product['p_cat_id'];
    $pro_title = $row_product['product_title'];
    $pro_price = $row_product['product_price'];
    $pro_desc = $row_product['product_desc'];
    $pro_img = $row_product['product_img'];

    $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";
    $run_p_cat = mysqli_query($conn, $get_p_cat);
    $row_p_cat = mysqli_fetch_array($run_p_cat);

    $p_cat_title = $row_p_cat['p_cat_title'];
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
                    <!--Thu tu trang-->
                    <li>
                        <a href="index.php">Trang chủ</a>
                    </li>
                    <li>
                        <a href="cuahang.php">Cửa hàng</a>
                    </li>
                    <li>
                        <a href="cuahang.php?p_cat=<?php echo $p_cat_id; ?>"><?php echo $p_cat_title; ?></a>
                    </li>
                    <li>
                        <?php
                        echo $pro_title;
                        ?>
                    </li>
                </ul>
            </div>

            <div class="col-md-12">
                <div id="productMain" class="row">
                    <div class="col-sm-6">
                        <div id="mainImage">
                            <div id="myCarousel" class="carousel slide" data-target="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                </ol>

                                <div class="carousel-inner">
                                    <div class="item active">
                                        <center><img src="admin_area/product_images/<?php echo $pro_img; ?>"
                                                alt="Product 1-a" class="img-responsive"></center>
                                    </div>
                                    <div class="item">
                                        <center><img src="admin_area/product_images/<?php echo $pro_img; ?>"
                                                alt="Product 1-b" class="img-responsive"></center>
                                    </div>
                                    <div class="item">
                                        <center><img src="admin_area/product_images/<?php echo $pro_img; ?>"
                                                alt="Product 1-c" class="img-responsive"></center>
                                    </div>
                                </div>

                                <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Truoc</span>
                                </a>

                                <a href="#myCarousel" class="right carousel-control" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Sau</span>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="thumbs">
                            <div class="col-xs-4">
                                <a data-target="#myCarousel" data-slide-to="0" href="#" class="thumb">
                                    <img src="admin_area/product_images/<?php echo $pro_img; ?>" alt="Product 1-a"
                                        class="img-responsive">
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a data-target="#myCarousel" data-slide-to="1" href="#" class="thumb">
                                    <img src="admin_area/product_images/<?php echo $pro_img; ?>" alt="Product 1-b"
                                        class="img-responsive">
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a data-target="#myCarousel" data-slide-to="2" href="#" class="thumb">
                                    <img src="admin_area/product_images/<?php echo $pro_img; ?>" alt="Product 1-c"
                                        class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="box">
                            <h1 class="text-center"><?php echo $pro_title; ?></h1>

                            <form action="chitiet.php?add_cart=<?php echo $product_id; ?>" class="form-horizontal"
                                method="POST">
                                <div class="form-group">
                                    <label for="" class="col-md-5 control-label">Số lượng</label>

                                    <div class="col-md-7">
                                        <input type="number" value=1 min=1 name="product_qty" style="width:50px;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 control-label">Kích cỡ</label>
                                    <div class="col-md-7">
                                        <select name="product_size" class="form-control" required
                                            oninput="setCustomValidity('')"
                                            oninvalid="setCustomValidity('Phải chọn kích cỡ sản phẩm')">

                                            <option disabled selected>Lựa chọn kích cỡ</option>
                                            <option>Small</option>
                                            <option>Medium</option>
                                            <option>Large</option>

                                        </select>
                                    </div>
                                </div>

                                <?php add_cart(); ?>

                                <p class="price"><strong><?php echo $pro_price; ?> đ</strong></p>

                                <p class="text-center buttons">
                                    <button class="btn btn-primary i fa fa-shopping-cart"> Thêm giỏ hàng</button>
                                </p>
                            </form>
                        </div>

                        
                    </div>
                </div>

                <div class="box" id="details">
                    <h4>Chi tiết sản phẩm</h4>
                    <p>
                        <?php echo $pro_desc; ?>
                    </p>
                    <h4>Size</h4>
                    <ul>
                        <li>Small</li>
                        <li>Medium</li>
                        <li>Large</li>
                    </ul>
                </div>

                <div id="row same-heigh-row">
                    <div class="col-md-3 col-sm-6">
                        <div class="box same-height headline">
                            <h3 class="text-center">Sản phẩm liên quan</h3>
                        </div>
                    </div>

                    <?php

                    $get_products = "select * from products order by rand() desc limit 0,3";
                    $run_products = mysqli_query($conn, $get_products);

                    while ($row_products = mysqli_fetch_array($run_products)) {
                        $pro_id = $row_products['product_id'];
                        $pro_title = $row_products['product_title'];
                        $pro_price = $row_products['product_price'];
                        $pro_img = $row_products['product_img'];

                        echo "
                        <div class='col-md-3 col-sm-6 center-responsive'>
                            <div class='product same-height'>
                                <a href='chitiet.php?pro_id='$pro_id'>
                                    <img class='img-responsive' src='admin_area/product_images/$pro_img'>
                                </a>

                                <div class='text'>
                                    <h3>
                                        <a href='chitiet.php?pro_id=$pro_id'> $pro_title </a>
                                    </h3>
                                    <p class='price'><strong>$pro_price đ</strong></p>
                                </div>
                            </div>
                        </div>
                    ";
                    }
                    ?>

                </div>
            </div>

        </div>

    </div>
    <!--Ket thuc content cua san pham-->

    <?php

    include("includes/footer.php");
    ?>


    <script src="js/jquery-331.js"></script>
    <script src="js/boostrap-337.js"></script>


    <script>
    $(document).ready(function() {
        $('.nav-toggle').click(function() {
            $('.panel-collapse,.collapse-data').slideToggle(700, function() {

                if ($(this).css('display') == 'none') {
                    $(".hide-show").html('Mở');
                } else {
                    $(".hide-show").html('Ẩn');
                }

            });
        });

        $(function() {
            $.fn.extend({
                filterTable: function() {
                    return this.each(function() {

                        $(this).on('keyup', function() {

                            var $this = $(this),
                                search = $this.val().toLowerCase(),
                                target = $this.attr('data-filters'),
                                handle = $(target),
                                rows = handle.find('li a');

                            if (search == '') {
                                rows.show();
                            } else {
                                rows.each(function() {
                                    var $this = $(this);

                                    $this.text().toLowerCase()
                                        .indexOf(
                                            search) === -1 ?
                                        $this.hide() : $this.show();
                                });
                            }
                        });
                    });
                }
            });
            $('[data-action="filter"][id="dev-table-filter"]').filterTable();
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        function getProducts() {

            var sPath = '';
            var aInputs = $('li').find('.get_manufacturer');
            var aKeys = Array();
            var aValues = Array();

            iKey = 0;

            $.each(aInputs, function(key, oInput) {
                if (oInput.checked) {
                    aKeys[iKey] = oInput.value;
                }
                iKey++;
            });

            if (aKeys.length > 0) {
                var sPath = '';

                for (var i = 0; i < aKeys.length; i++) {
                    sPath = sPath + 'man[]=' + aKeys[i] + '&';
                }
            }

            var aInputs = Array();
            var aInputs = $('li').find('.get_p_cat');
            var aKeys = Array();
            var aValues = Array();

            iKey = 0;

            $.each(aInputs, function(key, oInput) {
                if (oInput.checked) {
                    aKeys[iKey] = oInput.value;
                }
                iKey++;
            });

            if (aKeys.length > 0) {
                var sPath = '';

                for (var i = 0; i < aKeys.length; i++) {
                    sPath = sPath + 'p_cat[]=' + aKeys[i] + '&';
                }
            }

            var aInputs = Array();
            var aInputs = $('li').find('.get_cat');
            var aKeys = Array();
            var aValues = Array();

            iKey = 0;

            $.each(aInputs, function(key, oInput) {
                if (oInput.checked) {
                    aKeys[iKey] = oInput.value;
                }
                iKey++;
            });

            if (aKeys.length > 0) {
                var sPath = '';

                for (var i = 0; i < aKeys.length; i++) {
                    sPath = sPath + 'cat[]=' + aKeys[i] + '&';
                }
            }

            $('#wait').html('<img src="images/load.gif"');

            $.ajax({
                url: "load.php",
                method: "POST",

                data: sPath + 'saction=getProducts',

                success: function(data) {

                    $('#products').html('');
                    $('#products').html(data);
                    $('#wait').empty();
                }
            });

            $.ajax({
                url: "load.php",
                method: "POST",

                data: sPath + 'saction=getPaginator',

                success: function(data) {

                    $('.pagination').html('');
                    $('.pagination').html(data);
                }
            });
        }

        $('.get_manufacturer').click(function() {
            getProducts();
        });

        $('.get_p_cat').click(function() {
            getProducts();
        });
        $('.get_cat').click(function() {
            getProducts();
        });
    });
    </script>
</body>

</html>
</body>

</html>