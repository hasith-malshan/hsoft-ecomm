<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin SignIn</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);min-height: 100px;">

    <div class="container-fluid d-flex justify-content-center" style="margin-top: 200px;">

        <div class="row align-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text text-center title-1">
                            Hi, Welcome to HSOFT Admins
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 p-5">
                <div class="row">
                    <div class="col-6 d-none d-md-block background" style="height: 300px;"></div>
                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="fs-1">
                                    Admin Sign In
                                </p>
                            </div>
                            <div class="col-12 h5">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control" id="e">
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="adminverification();">Send Verifivation code to Login</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger">Back to User's Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="verificatiomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter the verification code you got by an Email.</label>
                            <input type="text" class="form-control" id="v" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 fixed-bottom text-center">
                <p class=""> &copy; 2021 HSOFT.lk All Rights Reserved </p>
            </div>

        </div>
    </div>


    <script src="script,.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>