<?php
session_start();
if (isset($_SESSION["u"])) {

?>
    <script src="script,.js"></script>
    <script>
        goToHome();
    </script>

<?php


} else {

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eshop</title>
        <link rel="icon" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="main-background">

<style>
    label{
        font-weight: bold;
    }
</style>

        <div class="container-fluid vh-100 d-flex justify-content-center">

            <div class="row align-content-center">

                <!-- header -->
                <div class="col-12 mt-5">
                    <div class="row ">
                        <div class="col-12 logo">
                        </div>
                        <div>
                            <p class="text-center title-1">Hi, Welcome to HSOFT</p>
                        </div>
                    </div>
                </div>
                <!-- header -->

                <!-- content -->
                <div class="col-12">

                    <div class="row ">

                        <div class="col-6 background d-none d-md-block d-lg-block">
                        </div>



                        <div class="col-12 col-md-6 col-lg-6" id="signInbox">
                            <div class="row g-3">

                                <div class="col-12 fw-bold fs-4 text">
                                    Create new Account
                                    <p class="text-danger" id="msg"></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" id="fname">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" id="lname">
                                </div>

                                <div class="col-12">
                                    <label for="">Email</label>
                                    <input type="text" name="" class="form-control" id="email">
                                </div>

                                <div class="col-12">
                                    <label for="">Password</label>
                                    <input type="password" name="" class="form-control" id="password">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="">mobile</label>
                                    <input type="text" class="form-control" id="mobile">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Gender </label>
                                    <select name="" class="form-select" id="gender">

                                        <?php
                                        require "connection.php";

                                        $r = Database::s("SELECT * FROM `gender`");

                                        $n = $r->num_rows;

                                        for ($i = 0; $i < $n; $i++) {

                                            $d = $r->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $d["id"] ?>"> <?php echo $d["name"]; ?> </option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                </div>
                                <div class="col-12 col-md-6 d-grid">
                                    <button class="btn btn-primary col-12" onclick="signUp();">Sign up</button>
                                </div>
                                <div class="col-12 col-md-6">
                                    <button class="btn btn-dark col-12" onclick="changeView();">Already have an account.? sign in </button>
                                </div>

                            </div>
                        </div>




                        <div class="col-12 col-md-6 d-none" id="signUpbox">
                            <div class="row g-3">

                                <div class="col-12">
                                    <p class="title2 fs-3 fw-bold">Sign In To Your Account</p>
                                    <p class="text-danger" id="msg2"></p>
                                </div>


                                <?php

                                $e = "";
                                $p = "";

                                if (isset($_COOKIE["e"])) {
                                    $e = $_COOKIE["e"];
                                }
                                if (isset($_COOKIE["p"])) {
                                    $p = $_COOKIE["p"];
                                }
                                ?>

                                <div class="col-12">
                                    <label for="">Email</label>
                                    <input type="text" name="" class="form-control" id="email2" value="<?php echo $e; ?>">
                                </div>
                                <div class="col-12">
                                    <label for="">Password</label>
                                    <input type="password" name="" class="form-control" id="password2" value="<?php echo $p; ?>" class="col-10">

                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="remember">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <a href="#" class="link-primary" onclick="fogotpassword();" style="color: blue; font-weight:bold;">Fogot Password..???</a>


                                </div>
                                <div class="col-12 col-md-6 d-grid">
                                    <button class="btn btn-primary col-12" onclick="signIn();">Sign In</button>
                                </div>
                                <div class="col-12 col-md-6">
                                    <button class="btn btn-danger col-12" onclick="changeView();">New to shop .? join now </button>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <!-- content -->

                <!-- footer -->
                <div class="col-12 fixed-bottom footer">
                    <p class="text-center ">
                        &copy; 2021 eShop.lk All right reserved.
                    </p>
                </div>
                <!-- footer -->
            </div>
        </div>



        <div class="modal fade" tabindex="-1" id="fogetPasswordModle">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label for="">verification code (Please check your email inbox)</label>
                                <input type="text" name="" class="form-control" id="vc">
                            </div>
                            <div class="input-group  col-12">
                                <input type="password" class="form-control" placeholder="Enter your new password" aria-label="Recipient's username" aria-describedby="button-addon2" id="np">
                                <button class="btn btn-outline-primary" type="button" id="npb" onclick="showP1();">show</button>
                            </div>
                            <div class="input-group  col-12">
                                <input type="password" class="form-control" placeholder="Re-Enter your new password" aria-label="Recipient's username" aria-describedby="button-addon2" id="rnp">
                                <button class="btn btn-outline-primary" type="button" id="rnpb" onclick="showP2();">show</button>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="bootstrap.js"></script>
        <script src="script,.js"></script>

    </body>

    </html>

<?php
}

?>