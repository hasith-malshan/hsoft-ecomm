<?php

require "connection.php";

$seachText = $_GET["t"];
$seachSelect = $_GET["s"];
$results_per_page = 4;
$pageno = $_GET["p"];


$availbleTxt = "
<div class='col-12 mt-2'>
<div class='row'>
    <div class='col-12 text-center'><span class='text-white text-center fs-1'>No products yet</span></div>
</div>
</div>
";


if (empty($seachText) && $seachSelect == 0) {
    $n = 0;
    $number_of_pages = 0;
?>
    <div class="col-12 mt-2">

        <div class="row">
            <div class="col-12 text-center"><span class="text-white text-center fs-1">Please Enter Keyword or Select Category to search</span></div>
        </div>

    </div>
<?php
} else if (!empty($seachText) && $seachSelect == 0) {
    $product = Database::s("SELECT * FROM `product` WHERE  `description` LIKE '%" . $seachText . "%'");
    $d = $product->num_rows;
    $row =  $product->fetch_assoc();
    $result_per_page = 4;
    $number_of_pages = ceil($d / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;
    $textSearch = Database::s("SELECT * FROM `product` WHERE `title` LIKE '%" . $seachText . "%' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n = $textSearch->num_rows;

    if ($n == 0) {
        echo $availbleTxt;
    }
} else if ($seachSelect != 0 && empty($seachText)) {
    $product = Database::s("SELECT * FROM `product` WHERE `catagory_id` = '" . $seachSelect . "' AND `status_id`='1' ");
    $d = $product->num_rows;
    $row =  $product->fetch_assoc();
    $result_per_page = 4;
    $number_of_pages = ceil($d / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;
    $textSearch = Database::s("SELECT * FROM `product` WHERE `catagory_id` = '" . $seachSelect . "' AND `status_id`='1' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n = $textSearch->num_rows;

    if ($n == 0) {
        echo $availbleTxt;
    }
} else if (!empty($seachText) && $seachSelect != 0) {
    $product = Database::s("SELECT * FROM `product` WHERE `catagory_id` = '" . $seachSelect . "' AND `title` LIKE '%" . $seachText . "%' AND `status_id`='1' OR `description` LIKE '%" . $seachText . "%';");
    $d = $product->num_rows;
    $row =  $product->fetch_assoc();
    $result_per_page = 4;
    $number_of_pages = ceil($d / $result_per_page);
    $page_first_result = ((int)$pageno - 1) * $result_per_page;
    $textSearch = Database::s("SELECT * FROM `product` WHERE `catagory_id` = '" . $seachSelect . "' AND `title` LIKE '%" . $seachText . "%' AND `status_id`='1' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
    $n = $textSearch->num_rows;

    if ($n == 0) {
        echo $availbleTxt;
    }
} else {
    $n = 0;
    $number_of_pages = 0;

?>

    <div class="col-12 mt-2">
        <div class="row">
            <div class="col-12 text-center"><span class="text-white text-center fs-1">No Result Found</span></div>
        </div>
    </div>

<?php
}




if ($n > 0) {
?>

    <div class="col-12 mt-2">
        <div class="row  mb-5">
            <div class="col-12 col-xl-10 offset-xl-1 col-xxl-8 offset-xxl-2" id="pdiv">
                <div class="row" id="pdeatails">
                    <?php
                    for ($i = 0; $i < $n; $i++) {
                        $prod = $textSearch->fetch_assoc();


                        $pimg = Database::s("SELECT * FROM `image` WHERE `product_id`='" . $prod["id"] . "' ");
                        $imgRow = $pimg->fetch_assoc();


                    ?>

                        <div class="card card1 col-6 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;">
                            <img src="<?php echo $imgRow["code"] ?>" class="card-img-top mt-2 border border-2 border-secondary">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="card-title text-center mb-1"><?php echo $prod["title"] ?> <br />
                                                <div class="row justify-content-center mt-2">
                                                    <span class="badge bg-info text-dark text-center col-6">New</span>
                                                </div>

                                            </h5>


                                            <div class="row text-center">
                                                <div class="col-12 d-inline"> <span class="text-primary fs-5">Rs <?php echo $prod["price"] ?> .00</span><br>
                                                </div>

                                                <?php

                                                if ((int)$prod["qty"] > 0) {

                                                ?>
                                                    <span class="text-warning">In stock</span>
                                                    <input type="number" class="form-control my-3 d-none" value="1" id="qtyTxt<?php echo $prod['id'] ?>">
                                                    <div class="col-12 d-grid mt-1"><a href="singleProductView.php?id=<?php echo $prod['id'] ?>" class="btn btn-success">Buy now</a></div>


                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="col-12 mt-1 "><span class="btn " onclick="addToCart(<?php echo $prod['id'] ?>)"><i class="bi bi-cart-fill text-white fs-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to cart"></i></span></div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="col-12 mt-3"> <span class="" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart fs-1" id="watch<?php echo $prod['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to watchlist"></i></span></div>
                                                        </div>
                                                    </div>

                                                <?php

                                                } else { ?>
                                                    <span class="text-danger">Out of stoke</span>
                                                    <button class="btn btn-warning">Request more Products</button>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="col-12 mt-1 "><span class="btn "><i class="bi bi-cart-fill text-white fs-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="This product is ot of stock you cant add to Cart"></i></span></div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="col-12 mt-3"> <span class="" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart fs-1" id="watch<?php echo $prod['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to watchlist"></i></span></div>
                                                        </div>
                                                    </div>



                                                <?php

                                                }
                                                ?>



                                            </div>

                                        </div>

                                    </div>
                                </div>






                            </div>
                        </div>


                    <?php

                    }

                    ?>
                    <!-- pagination -->
                    <div class="col-12 mb-3 mt-3">
                        <div class="pagination d-flex justify-content-center">
                            <?php
                            if ($pageno != 1) {
                            ?>
                                <button class=" btn btn-secondary" onclick="basicSearch(<?php echo $pageno - 1; ?>);">&laquo;</button>
                                <?php
                            }

                            for ($page = 1; $page <= $number_of_pages; $page++) {
                                if ($page == $pageno) {
                                ?>
                                    <button class="ms-1 btn btn-dark active" onclick="basicSearch(<?php echo $page; ?>);"><?php echo $page; ?></button>
                                <?php
                                } else {
                                ?>
                                    <button class="ms-1 btn btn-secondary" onclick="basicSearch(<?php echo $page; ?>);"><?php echo $page; ?></button>
                            <?php
                                }
                            }
                            ?>
                            <?php
                            if ($pageno < $number_of_pages) {
                            ?>
                                <button class="ms-1 btn btn-secondary" onclick="basicSearch(<?php echo $pageno + 1; ?>);">&raquo;</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- pagination -->
                </div>
            </div>
        </div>
    </div>

<?php

}

?>