<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>

<html>

<head>
    <title>eShop | Advance Search</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="background_img1">

    <div class="container-fluid">
        <div class="row">



            <!-- Header -->
            <div class="col-12 bg-light border border-primary border-start-0 border-end-0 border-top-0">
                <?php require "header.php"; ?>
            </div>
            <!-- Header -->

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Advance Search</li>
                </ol>
            </nav>

            <!-- Logo & Title -->
            <div class="col-12 bg-light" style=" background-image: linear-gradient(90deg, #384643 0%, #919bca 100%);">
                <div class="row">
                    <div class="offset-0 offset-lg-4 col-12 col-lg-4 py-2 px-4 px-lg-0">
                        <div class="row">
                            <div class="col-2">
                                <div class="row">
                                    <img src="resources/logo.svg" width="70px" height="70px" />
                                </div>
                            </div>
                            <div class="col-10 d-flex align-items-center">
                                <div class="row">
                                    <h2 class="text-black-50 fw-bold">Advance Search</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Logo & Title -->

            <!-- Body -->
            <div class="offset-0 offset-lg-2 col-12 col-lg-8 mt-3 mb-3 rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-9 col-lg-10 mt-3 mb-2 ms-2 ms-lg-0">
                                <input type="text" class="form-control fw-bold" id="s" placeholder="Type a keyword to search...(Search on Description)" />
                            </div>
                            <div class="col-2 d-grid mt-3 mb-2 ms-2 ms-lg-0">
                                <button class="btn btn-primary fw-bold" onclick="advanceSearch();">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-primary border-3" />
                            </div>
                        </div>
                    </div>
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4 mb-2 mb-lg-3">
                                        <select class="form-select" id="c">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $rs_cat = Database::s("SELECT * FROM `catagory`;");
                                            $nr_cat = $rs_cat->num_rows;

                                            for ($i = 0; $i < $nr_cat; $i++) {
                                                $cat = $rs_cat->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-2 mb-lg-3">
                                        <select class="form-select" id="b">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $rs_brand = Database::s("SELECT * FROM `brand`;");
                                            $nr_brand = $rs_brand->num_rows;

                                            for ($i = 0; $i < $nr_brand; $i++) {
                                                $brand = $rs_brand->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $rs_model = Database::s("SELECT * FROM `model`;");
                                            $nr_model = $rs_model->num_rows;

                                            for ($i = 0; $i < $nr_model; $i++) {
                                                $model = $rs_model->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $model['id']; ?>"><?php echo $model['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-3">
                                        <select class="form-select" id="con">
                                            <option value="0">Select Condition</option>
                                            <?php
                                            $rs_cond = Database::s("SELECT * FROM `condition`;");
                                            $nr_cond = $rs_cond->num_rows;

                                            for ($i = 0; $i < $nr_cond; $i++) {
                                                $cond = $rs_cond->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cond['id']; ?>"><?php echo $cond['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select" id="col">
                                            <option value="0">Select Colour</option>
                                            <?php
                                            $rs_color = Database::s("SELECT * FROM `color`;");
                                            $nr_color = $rs_color->num_rows;

                                            for ($i = 0; $i < $nr_color; $i++) {
                                                $color = $rs_color->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $color['id']; ?>"><?php echo $color['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2 mb-lg-2">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" id="pfrom" class="form-control" placeholder="Price from" aria-label="Amount (to the nearest rupee)">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" id="pto" class="form-control" placeholder="Price to" aria-label="Amount (to the nearest rupee)">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class=""><span class="text-white text-center fs-3"><a href="products.php?id=x" class="text-decoration-none">All Products </a></span></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-3 col-md-8 mt-2 mb-2">
                                <hr class="border border-primary border-3" />
                            </div>
                            <div class="col-6 col-md-4 mt-2 mb-2">
                                <select class="form-control border-2 border-top-0 border-end-0 border-bottom border-start-0 border-dark fw-bold" id="sort">
                                    <option value="1">Price: Low to High</option>
                                    <option value="2">Price: High to Low</option>
                                    <option value="3">Quantity: Low to High</option>
                                    <option value="4">Quantity: High to Low</option>
                                </select>
                            </div>
                            <div class="col-3 mt-2 mb-2 d-md-none">
                                <hr class="border border-primary border-3" />
                            </div>
                        </div>
                    </div>

                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <hr class="border border-primary border-3" />
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="offset-0 offset-lg-1 col-12 col-lg-10 mb-3 rounded">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <div class="row" id="resultbox">
                                            <!-- searched products will be view here -->
                                            <h4 class="text-white fw-bold text-center">Search to view products here</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                                <hr class="border border-primary border-3" />
                            </div>

                            <!-- Pagination -->
                            <div class="col-12 bg-white p-2 d-flex justify-content-center mb-4 mt-3 fw-bold" id="pagbox" style=" background-image: linear-gradient(90deg, #384643 0%, #919bca 100%);">
                                <div class="pagination">
                                    <!-- <a href="#">&laquo;</a>
                                    <a href="#" class="active">1</a>
                                    <a href="#">2 </a>
                                    <a href="#">&raquo;</a> -->
                                </div>
                            </div>
                            <!-- Pagination -->
                        </div>
                    </div>

                </div>
            </div>
            <!-- Body -->



            <!-- Footer -->
            <?php require "footer.php"; ?>
            <!-- Footer -->

        </div>
    </div>

    <script src="script,.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>