<?php

session_start();

require "connection.php";
if (isset($_SESSION["u"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>


    <style>

    </style>

    <body class="background_img1">


        <style>
            label,
            span,
            .h6 {
                color: white;
            }
        </style>

        <?php

        if (isset($_SESSION["u"])) {

        ?>


            <div class="container-fluid my-5">
                <div class="row">

                    <nav aria-label="breadcrumb col-12">
                        <ol class="breadcrumb" style="background: transparent;">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">My Profile</li>
                        </ol>
                    </nav>

                    <div class="col-md-3 border-right rounded ">
                        <div class="d-flex flex-column align-items-center">


                            <?php
                            $profileImg = Database::s("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ; ");
                            $n = $profileImg->num_rows;


                            if ($n == 0) {
                            ?>
                                <img src="resources/demoProfileImg.jpg" class="rounded mt-5" width="150px" id="prev">
                            <?php
                            } else {
                                $profileImgData = $profileImg->fetch_assoc();

                            ?>
                                <img src="<?php echo $profileImgData["code"] ?>" class="rounded mt-5" width="150px" id="prev">
                            <?php


                            }

                            ?>

                            <span class="fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"] ?></span>
                            <span> <?php echo $_SESSION["u"]["email"]; ?></span>
                            <input type="file" class="d-none" id="profileImage" accept="image/*">
                            <label for="profileImage" class="btn btn-primary my-3" onclick="changeProfileImg();">Update Profile Image</label>
                        </div>
                    </div>

                    <div class="col-md-5 border-end">
                        <div class="p-3 py-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <h4 class="text-center text-white">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <span>Name</span>
                                    <input type="text" class="form-control" placeholder="Enter name" value="<?php echo $_SESSION["u"]["fname"]; ?>" id="fname">
                                </div>
                                <div class="col-md-6">
                                    <span>Surname</span>
                                    <input type="text" class="form-control" placeholder="Enter sirname" value="<?php echo $_SESSION["u"]["lname"]; ?>" id="lname">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <span>Mobile Number</span>
                                    <input type="text" class="form-control" placeholder="Enter Mobile number" value="<?php echo $_SESSION["u"]["mobile"]; ?>" id="mobile">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <span>Password</span>
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="password" class="form-control" placeholder="Enter Password" value="<?php echo $_SESSION["u"]["password"]; ?>" id="showPw" readonly>
                                        </div>
                                        <button class="btn btn-outline-primary col-2" type="button" id="showPwB" onclick="showPw();">Show</button>
                                    </div>

                                </div>
                            </div>




                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <span>Email Address</span>
                                    <input type="email" class="form-control" placeholder="Enter Email Address" value="<?php echo $_SESSION["u"]["email"]; ?>" id="" readonly>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <span>Regestered Date and Time</span>
                                    <input type="text" class="form-control" placeholder="<?php echo $_SESSION["u"]["regester_date"]; ?>" value="" readonly>
                                </div>
                            </div>

                            <?php
                            $email = $_SESSION["u"]["email"];

                            $address = Database::s("SELECT * FROM `user_has_address` WHERE  `user_email`='" . $email . "' ");


                            if ($address->num_rows == 1) {
                                $addressData = $address->fetch_assoc();

                            ?>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <span>Address Line 01</span>
                                        <input type="text" class="form-control" placeholder="Address Line 01" value="<?php echo $addressData["line1"]; ?>" id="line1">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <span>Address Line 02</span>
                                        <input type="text" class="form-control" placeholder="Address Line 02" value="<?php echo $addressData["line2"]; ?>" id="line2">
                                    </div>
                                </div>



                                <?php
                                $city_id = $addressData["city_id"];
                                $cityData = Database::s("SELECT * from `city` where  `id`='" . $city_id . "' ");
                                $cityName = $cityData->fetch_assoc();


                                $district_id = $cityName["district_id"];
                                $districtData = Database::s("SELECT * from `district` where  `id`='" . $district_id . "' ");
                                $districtName = $districtData->fetch_assoc();

                                $province_id = $districtName["province_id"];
                                $provinceData = Database::s("SELECT * from `province` where  `id`='" . $province_id . "' ");
                                $provinceName = $provinceData->fetch_assoc();


                                $genderID = $_SESSION["u"]["gender_id"];
                                $genderData = Database::s("SELECT * FROM `gender` WHERE  `id`='" . $genderID . "' ");
                                $genderName = $genderData->fetch_assoc();




                                ?>

                                <div class="row mt-2">

                                    <div class="col-md-6">
                                        <span>City</span>
                                        <input type="text" class="form-control" placeholder="Enter city name" value="<?php echo $cityName["name"]; ?>" id="city">
                                    </div>

                                    <div class="col-md-6">
                                        <span>Postal Code</span>
                                        <input type="text" class="form-control" placeholder="Enter Postal Code" value="<?php echo $cityName["postal_code"]; ?>" id="pCode">
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">


                                            <?php

                                            $userDistrictS = Database::s("SELECT * from `district` WHERE `id`='" . $cityName['district_id'] . "';");
                                            $userDistrictSD = $userDistrictS->fetch_assoc();

                                            $districtData1 = Database::s("SELECT * from `district` WHERE `id`!= '" . $userDistrictSD["id"] . "';");
                                            $dNr = $districtData1->num_rows;


                                            ?>

                                            <label for="" class="form-label">District</label>
                                            <select name="" id="" class="form-control">
                                                <option value="" selected><?php echo $userDistrictSD["name"] ?></option>
                                                <?php

                                                if ($dNr > 0) {

                                                    for ($i = 0; $i < $dNr; $i++) {
                                                        $districtName1 = $districtData1->fetch_assoc();
                                                ?>
                                                        <option value=""><?php echo $districtName1["name"]  ?></option>
                                                <?php
                                                    }
                                                }

                                                ?>


                                            </select>
                                        </div>

                                        <div class="col-md-6">

                                            <?php

                                            $userProvinceS = Database::s("SELECT * from `province` WHERE `id`='" . $userDistrictSD['province_id'] . "';");
                                            $userProvinceD = $userProvinceS->fetch_assoc();

                                            $provinceData1 = Database::s("SELECT * from `province` WHERE `id`!= '" . $userProvinceD["id"] . "' ;");
                                            $pNr = $provinceData1->num_rows;

                                            ?>
                                            <label for="" class="form-label">Province</label>
                                            <select name="" id="" class="form-control">
                                                <option value="" selected><?php echo $userProvinceD["name"] ?></option>
                                                <?php

                                                if ($dNr > 0) {

                                                    for ($i = 0; $i < $pNr; $i++) {
                                                        $provinceName1 = $provinceData1->fetch_assoc();
                                                ?>
                                                        <option value=""><?php echo $provinceName1["name"]  ?></option>
                                                <?php
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <span>Gender</span>
                                                <input type="text" class="form-control" placeholder="Gender" value="<?php echo $genderName["name"]; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                                    </div>

                                </div>

                            <?php
                            } else {

                            ?>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <span>Address Line 01</span>
                                        <input type="text" class="form-control" placeholder="Address Line 01" value="" id="line1">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <span>Address Line 02</span>
                                        <input type="text" class="form-control" placeholder="Address Line 02" value="" id="line2">
                                    </div>
                                </div>


                                <div class="row mt-2">

                                    <div class="col-md-6">
                                        <span>City</span>
                                        <input type="text" class="form-control" placeholder="Enter city name" value="" id="city">
                                    </div>

                                    <div class="col-md-6">
                                        <span>Postal Code</span>
                                        <input type="text" class="form-control" placeholder="Enter Postal Code" value="" id="pCode">
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">


                                            <?php



                                            $districtData1 = Database::s("SELECT * from `district`;");
                                            $dNr = $districtData1->num_rows;


                                            ?>

                                            <label for="" class="form-label">District</label>
                                            <select name="" id="" class="form-control">
                                                <option value="" selected>Select your District</option>
                                                <?php

                                                if ($dNr > 0) {

                                                    for ($i = 0; $i < $dNr; $i++) {
                                                        $districtName1 = $districtData1->fetch_assoc();
                                                ?>
                                                        <option value=""><?php echo $districtName1["name"]  ?></option>
                                                <?php
                                                    }
                                                }

                                                ?>


                                            </select>
                                        </div>

                                        <div class="col-md-6">

                                            <?php
                                            $provinceData1 = Database::s("SELECT * from `province` ;");
                                            $pNr = $provinceData1->num_rows;

                                            ?>
                                            <label for="" class="form-label">Province</label>
                                            <select name="" id="" class="form-control">
                                                <option value="" selected>Select Province</option>
                                                <?php

                                                if ($dNr > 0) {

                                                    for ($i = 0; $i < $pNr; $i++) {
                                                        $provinceName1 = $provinceData1->fetch_assoc();
                                                ?>
                                                        <option value=""><?php echo $provinceName1["name"]  ?></option>
                                                <?php
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>

                                    </div>


                                    <?php

                                    $genderID = $_SESSION["u"]["gender_id"];
                                    $genderData = Database::s("SELECT * FROM `gender` WHERE  `id`='" . $genderID . "' ");
                                    $genderName = $genderData->fetch_assoc();

                                    ?>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <span>Gender</span>
                                            <input type="text" class="form-control" placeholder="Gender" value="<?php echo $genderName["name"]; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                                    </div>

                                </div>




                            <?php

                            }

                            ?>














                        </div>
                    </div>
                <?php
            } else {
            }
                ?>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-white text-center">User C pannel</h2>
                        </div>
                        <div class="col-12 d-grid">
                            <a href="reqProducts.php?uid=<?php echo $_SESSION["u"]["email"] ?>"><button class="btn btn-primary mt-3 col-12">Requested Produts</button></a>
                        </div>
                        <div class="col-12 d-grid">
                            <button class="btn btn-outline-warning mt-3"><a href="purchaseHistory.php" class="text-decoration-none">My puchase history </a> </button>
                        </div>
                        <div class="col-12 d-grid">
                            <a href="purchaseHistory.php"><button class="btn btn-primary mt-3 col-12">Add Feedbacks</button></a>
                        </div>

                        <div class="col-12 d-grid">
                           <a href="messages.php?e=hasher22542@gmail.com" class="text-decoration-none"> <button class="btn btn-outline-primary mt-3 col-12">Contact Admin  </button> </a>
                        </div>

                    </div>


                </div>
                </div>




            </div>

            <div class="container-fluid">

                <div class="row">
                    <?php

                    require "footer.php";
                    ?>
                </div>

            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="bootstrap.js"></script>
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