<?php

session_start();
require "connection.php";

//$Admintest = Database::s("SELECT * FROM `ADMIN` WHERE `lname`='Admin2'; ");
//$_SESSION["a"] = $Admintest->fetch_assoc();

if (isset($_SESSION["a"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>HSOFT - Manage Products </title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    </head>

    <body id="page-top">
        <div id="wrapper">
            <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
                <div class="container-fluid d-flex flex-column p-0">
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-h-square"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>HSOFT ADMINS</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <?php
                    require "sidebar.php";
                    ?>
                    <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
                </div>
            </nav>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                            <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            </form>
                            <ul class="navbar-nav flex-nowrap ms-auto">
                                <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">

                                    </div>
                                </li>

                                <li class="nav-item dropdown no-arrow mx-1">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" href="messagesA.php"><span class="badge bg-danger badge-counter"></span><i class="fas fa-envelope fa-fw"></i></a>

                                    </div>
                                    <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                                </li>
                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                            <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION["a"]["fname"] ?></span><img class="border rounded-circle img-profile" src="assets/img/200112401196-Hasith%20Malshan%20-%20My%20Image.jpg"></a>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#">
                                                <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                </div>

                <div class="wrapper">
                <div class="container-fluid">

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="adminpannel.php">adminpannel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
    </ol>
</nav>
<!-- start of main Container -->
<!-- heading -->
<div class="row gy-3" id="addProductBox">
    <!-- start of main row -->

    <div class="col-12 mb-2 text-center">
        <h3 class="h2 fw-bold text-primary">Prodcut Listning</h3>
    </div>

    <!-- heading -->

    <!-- select Catagory,brand,modle -->
    <div class="col-lg-12">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label lbl1">All Catogory</label>
                        <div class="col-12 mb-2">
                            <select class="form-select" aria-label="Default select example" id="ca">
                                <option selected value="0">Select Catagory</option>
                                <?php

                                $catogoryS = Database::s("SELECT * FROM `catagory`;");
                                $catogoryNr = $catogoryS->num_rows;

                                for ($i = 0; $i < $catogoryNr; $i++) {
                                    $catogoryD = $catogoryS->fetch_assoc();
                                ?>
                                    <option value="<?php echo $catogoryD["id"] ?>"><?php echo $catogoryD["name"] ?></option>
                                <?php

                                }

                                ?>


                            </select>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label lbl1">Select Product Brand</label>
                        <div class="col-12 mb-2">
                            <select class="form-select" aria-label="Default select example" id="br">
                                <option selected value="0">Select Brand</option>

                                <?php

                                $brandS = Database::s("SELECT * FROM `brand`;");
                                $brandNr = $brandS->num_rows;


                                for ($i = 0; $i < $brandNr; $i++) {
                                    $brandD = $brandS->fetch_assoc();
                                ?>
                                    <option value="<?php echo $brandD["id"] ?>"><?php echo $brandD["name"] ?></option>
                                <?php

                                }

                                ?>



                            </select>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label lbl1">Select Product modle</label>
                        <div class="col-12 mb-2">
                            <select class="form-select" aria-label="Default select example" id="mo">
                                <option selected value="0">Select Modle</option>

                                <?php

                                $modleS = Database::s("SELECT * FROM `model`;");
                                $modleNr = $modleS->num_rows;

                                for ($i = 0; $i < $modleNr; $i++) {
                                    $modleD = $modleS->fetch_assoc();
                                ?>
                                    <option value="<?php echo $modleD["id"] ?>"><?php echo $modleD["name"] ?></option>
                                <?php

                                }

                                ?>
                            </select>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- select Catagory,brand,modle -->

    </div>
    <hr class="hr_breack1">

    <!-- title -->
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <label for="" class="form-label lbl1"> Add a title to your product</label>
            </div>
            <div class="offset-lg-2 col-12 col-lg-8">
                <input type="text " class="form-control" id="ti" />
            </div>
        </div>
    </div>
    <!-- title -->

    <hr class="hr_breack1">

    <!-- condition,color,qty -->
    <div class="col-12">
        <div class="row gy-3">


            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label lbl1"> Select Product Condition</label>
                    </div>
                    <div class="offset-lg-1 col-12 col-lg-3 form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" name="condition" checked id="bn">
                        <label class="form-check-label" for="bn">
                            Brand new
                        </label>
                    </div>
                    <div class="offset-lg-1 col-12 col-lg-3 form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" name="condition" id="us">
                        <label class="form-check-label" for="us">
                            Used
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label lbl1"> Select your color </label>
                    </div>
                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                        <input class="form-check-input " type="radio" value="" id="clr1" name="colorSelect">
                        <label class="form-check-label" for="clr1">
                            Gold
                        </label>
                    </div>
                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                        <input class="form-check-input " type="radio" value="" id="clr2" name="colorSelect">
                        <label class="form-check-label" for="clr2">
                            Silver
                        </label>
                    </div>
                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                        <input class="form-check-input " type="radio" value="" id="clr3" name="colorSelect">
                        <label class="form-check-label" for="clr3">
                            Graphite
                        </label>
                    </div>
                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                        <input class="form-check-input" type="radio" value="" id="clr4" name="colorSelect">
                        <label class="form-check-label" for="clr4">
                            Pacific Blue
                        </label>
                    </div>
                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                        <input class="form-check-input " type="radio" value="" id="clr5" name="colorSelect">
                        <label class="form-check-label" for="clr5">
                            Jet black
                        </label>
                    </div>
                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                        <input class="form-check-input " type="radio" value="" id="clr6" name="colorSelect">
                        <label class="form-check-label" for="clr6">
                            Rose Gold
                        </label>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="COL-12"> <label for="" class="form-label lbl1"> Add product quantity </label>
                        <input class="form-control" type="number" value="0" min="0" id="qty">
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- condition,color,qty -->

    <hr class="hr_breack1">

    <!-- payents,cost,method -->

    <div class="col-12">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12">
                            <label for="" class="form-label lbl1">Cost per Item</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest Ruppee)" id="cost">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- payents,cost,method -->

    <hr class="hr_breack1">

    <!-- dilivery Cost -->

    <div class="col-12 ">

        <div class="row">

            <div class="col-12">
                <label for="" class="form-label lbl1">Dilivery Cost</label>
            </div>

            <div class="col-12 col-lg-6 ">
                <div class="row">

                    <div class="offset-lg-1 col-12 col-lg-3">
                        <label for="" class="form-label">Dilivery Cost within Colombo</label>
                    </div>

                    <div class="col-12 col-lg-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest Ruppee)" id="dwc">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-12 col-lg-6 ">
                <div class="row">

                    <div class="offset-lg-1 col-12 col-lg-3">
                        <label for="" class="form-label">Dilivery Cost out of Colombo</label>
                    </div>

                    <div class="col-12 col-lg-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest Ruppee)" id="doc">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>

    <!-- dilivery Cost -->
    <hr class="hr_breack1">


    <!-- descrption -->
    <div class="col-12 ">
        <div class="row">
            <div class="col-12 ">
                <label for="" class="form-label lbl1">Product Description</label>
            </div>

            <div class="col-12  d-grid">
                <textarea name="" id="des" cols="100" rows="30" class="form-control mb-3" style="background-color: honeydew;"></textarea>
            </div>

        </div>
    </div>
    <!-- descrption -->

    <div class="col-12">
        <div class="row">

            <div class="col-12">
                <label for="" class="form-label lbl1"> Add product Image</label>
            </div>
            <div class="col-12 col-md-4 d-inline">

                <img src="resources/addproductimg.svg" alt="" class="img-thumbnail col-12" id="prev1">
                <div class="col-12">

                    <div class="row">

                        <div class="col-12 col-lg-6 ms-2 mt-2">
                            <input type="file" accept="image/*" class="form-control d-none" id="imgUploader1">
                            <label for="imgUploader1" class="btn btn-primary col-12 col-lg-4" onclick="changeImg1();">Upload</label>
                        </div>
                        <div class="col-6 col-lg-4 d-grid d-none">
                            <button class="btn btn-success">Upload </button>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-12 col-md-4 d-inline">

                <img src="resources/addproductimg.svg" alt="" class="img-thumbnail col-12" id="prev2">
                <div class="col-12">

                    <div class="row">

                        <div class="col-12 col-lg-6 ms-2 mt-2">
                            <input type="file" accept="image/*" class="form-control d-none" id="imgUploader2">
                            <label for="imgUploader2" class="btn btn-primary col-12 col-lg-4" onclick="changeImg2();">Upload</label>
                        </div>
                        <div class="col-6 col-lg-4 d-grid d-none">
                            <button class="btn btn-success">Upload </button>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-12 col-md-4 d-inline">

                <img src="resources/addproductimg.svg" alt="" class="img-thumbnail col-12" id="prev3">
                <div class="col-12">

                    <div class="row">

                        <div class="col-12 col-lg-6 ms-2 mt-2">
                            <input type="file" accept="image/*" class="form-control d-none" id="imgUploader3">
                            <label for="imgUploader3" class="btn btn-primary col-12 col-lg-4" onclick="changeImg3();">Upload</label>
                        </div>
                        <div class="col-6 col-lg-4 d-grid d-none">
                            <button class="btn btn-success">Upload </button>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
    <!-- product img -->
    <hr class="hr_breack1">

    <!-- notice -->
    <div class="col-12">
        <label class="form-lable lbl1" for="">
            Notice...
        </label>
        <label for="" class="form-lable">
            We are taking 5% of the prodct price from every product as a service charge.
        </label>
    </div>
    <!-- notice -->

    <!-- save product -->
    <div class="col-12 ">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4 d-grid">
                <button class="btn btn-success my-5" onclick="addProduct();">Add product </button>

            </div>
        </div>
    </div>
    <!-- save product -->

</div>
<!-- end of main row -->



</div>
                </div>

            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>


        </div>




        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="assets/js/theme.js"></script>
        <script src="script,.js"></script>
    </body>

    </html>
<?php
} else {
?>

    <script src="script,.js"></script>
    <script>
        goToIndex();
    </script>



<?php
}

?>