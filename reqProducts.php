<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
   $user1 = $_SESSION["u"]["email"];



?>

   <!DOCTYPE html>
   <html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>HSOFT | Requested  Products</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
      <link rel="icon" href="resources/logo.svg" />
      <link rel="stylesheet" href="bootstrap.min.css" />
      <link rel="stylesheet" href="style.css" />
   </head>

   <body class="background_img1">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="row  g-3">

                  <?php
                  require "header.php"
                  ?>
               </div>
            </div>


            <hr class="hr_breack1 mt-3">

            <?php

            $req = Database::s("SELECT * FROM `req` WHERE `user`='" . $user1 . "';");
            $reqNr = $req->num_rows;

            if ($reqNr > 0) {


               for ($i = 0; $i < $reqNr; $i++) {
                  $reqData = $req->fetch_assoc();

            ?>


                  <div class="col-12 mb-5 pb-2">
                     <div class="row">
                        <div class="offset-lg-1 col-12 col-lg-10">
                           <div class="row justify-content-center justify-content-lg-start">

                              <?php
                              $resultSet = Database::s("SELECT * FROM  `product` WHERE `id`='" . $reqData["product_id"] . "' ;");
                              $nr = $resultSet->num_rows;

                              if ($nr == 0) {
                              ?><div class=" text-center">
                                    <h1 class="text-white-50">No Products Yet</h1>
                                 </div>

                              <?php
                              }

                              for ($i = 0; $i < $nr; $i++) {
                                 $prod = $resultSet->fetch_assoc();


                              ?>
                                 <!-- This is Sigble product section start-->

                                 <?php

                                 $pImage = Database::s("SELECT * from `image` WHERE `product_id`='" . $prod["id"] . "'; ");
                                 $imgRow = $pImage->fetch_assoc();


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
                                                      <button class="btn btn-warning" onclick="req(<?php echo $prod['id'] ?>);">Request more Products</button>
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
                                 <!-- This is Sigble product section end-->
                              <?php
                              }
                              ?>


                           </div>
                        </div>
                     </div>
                  </div>

               <?php



               }
            } else {
               ?>

               <div class=" text-center">
                  <h1 class="text-white-50">No Products Yet</h1>
               </div>
            <?php
            }

            ?>


            <div class="col-12">

            </div>


            <!-- footer -->
            <?php
            require "footer.php"
            ?>
            <!-- footer -->
         </div>
      </div>



      <script src="bootstrap.js"></script>
      <script src="bootstrap.bundle.js"></script>
      <script>
         var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
         var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
         })
      </script>
      <script src="script,.js"></script>
   </body>

   </html>

   </html>



<?php
}


?>