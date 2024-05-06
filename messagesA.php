<?php
session_start();
if (isset($_SESSION["a"])) {
    $uemail = $_SESSION["a"]["email"];
    //$semail = $_GET["e"];

    if (isset($_GET["e"])) {
        $nameCode = $_GET["e"];
    } else {
        $nameCode = "";
    }
    //echo $semail;

?>
    <!DOCTYPE html>

    <html>

    <head>
        <title>eShop | Admin Messages</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="background_img1" onload="refresher('<?php echo $nameCode ?>');">

        <div class="container-fluid">
            <div class="row">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">adminpannel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                    </ol>
                </nav>



                <hr />

                <div class="col-12 py-5 px-4">
                    <div class="row rounded overflow-hidden shadow">
                        <div class="col-5 px-0 bg-white">
                            <div class="bg-white">
                                <div class="bg-white px-4 py-2">
                                    <h5 class="mb-0 py-1">Recent</h5>
                                </div>
                                <div class="msg-box">
                                    <div class="list-group rounded-0" id="rcv">

                                        <!-- Chat Users will be loaded here -->



                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7 px-3">
                            <div class="row">
                                <div class="col-12 px-0">
                                    <?php
                                    if (isset($_GET["e"])) {
                                    ?>
                                        <div class="bg-light" style="height: 50px;">
                                        <p class="text-dark text-center h1"> Messeging to :&nbsp;<?php echo $nameCode?></p>
                                        </div><?php
                                            }
                                                ?>

                                    <div class="row px-4 py-5 text-white chat_box " id="chatrow">

                                        <!-- The messages will be loaded here -->

                                    </div>
                                </div>
                                <div class="col-12 px-0">
                                    <div class="row bg-white">
                                        <!-- Message typing area -->
                                        <div class="col-12 mb-0 mt-auto">
                                            <div class="row">
                                                <div class="input-group">
                                                    <input type="text" id="msgtxt" placeholder="Type a message..." aria-describedby="sendbtn" class="form-control rounded border-0 py-2 px-3 bg-light" />
                                                    <div class="input-group-append">
                                                        <button id="sendbtn" class="btn btn-link fs-3" onclick="sendmessage('<?php echo $nameCode; ?>',1);"><i class="bi bi-cursor-fill"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Message typing area -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <?php require "footer.php"; ?>
                <!-- Footer -->

            </div>
        </div>

        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <!-- <script src="script,.js"></script> -->
        <script src="admin.js"></script>
    </body>

    </html>

<?php
} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
?>