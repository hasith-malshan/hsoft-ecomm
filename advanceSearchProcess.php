<?php

    require "connection.php";

    if(isset($_POST["s"])) {

        $s = $_POST["s"];
        $c = $_POST["c"];
        $b = $_POST["b"];
        $m = $_POST["m"];
        $con = $_POST["con"];
        $col = $_POST["col"];
        $pf = $_POST["pf"];
        $pt = $_POST["pt"];
        $sort = $_POST["st"];

        $pn;
        if(isset($_POST["pn"])) {
            $pn = $_POST["pn"];
        } else {
            $pn = 1;
        }

        // echo $s."\n".$c."\n".$b."\n".$m."\n".$con."\n".$col."\n".$pf."\n".$pt."\n".$pn;

        $pageno = $pn;
        $ss = "0"; //Which Sorting Method is used
        $rs_pro_pg;
        $rs_pro;
        $array;

        if(empty($s)) {
            echo "empty";
        } else {
        
            // Find product count for pagination
            if(!empty($s) && $c!=0) {
                $ss = "1-".$sort."-".$c;

                $rs_pro_pg = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `catagory_id`='".$c."';");

            } else if(!empty($s) && $b!=0) {
                $ss = "2-".$sort."-".$b;

                $rs_pro_pg = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `modle_has_brand_id` 
                    IN(SELECT `id` FROM `model_has_brand` WHERE `brand_id`='".$b."');");

            } else if(!empty($s) && $m!=0) {
                $ss = "3-".$sort."-".$m;

                $rs_pro_pg = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `modle_has_brand_id` 
                    IN(SELECT `id` FROM `model_has_brand` WHERE `model_id`='".$m."');");

            } else if(!empty($s) && $con!=0) {
                $ss = "4-".$sort."-".$con;

                $rs_pro_pg = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `condition_id`='".$con."';");

            } else if(!empty($s) && $col!=0) {
                $ss = "5-".$sort."-".$col;
                
                $rs_pro_pg = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `color_id`='".$col."';");

            } else if(!empty($s) && !empty($pf) && empty($pt)) {
                $ss = "6-".$sort."-".$pf;

                $rs_pro_pg = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `price`>='".$pf."';");

            } else if(!empty($s) && !empty($pt) && empty($pf)) {
                $ss = "7-".$sort."-".$pt;

                $rs_pro_pg = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `price`<='".$pt."';");

            } else if(!empty($s) && !empty($pf) && !empty($pt)) {
                $ss = "8-".$sort."-".$pf."-".$pt;

                $rs_pro_pg = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `price`>='".$pf."' AND `price`<='".$pt."';");

            } else if(!empty($s)) {
                $ss = "0-".$sort;

                $rs_pro_pg = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%';");
            }
            // Find product count for pagination

            $nr_pro_pg = $rs_pro_pg->num_rows;

            $results_per_page = 6;
            $number_of_pages = ceil($nr_pro_pg / $results_per_page);

            $offset = ((int)$pageno - 1) * $results_per_page;

            $order;
            if($sort==1) { //Sort by: Price: Low to High
                $order = '`price` ASC';
            } else if($sort==2) { //Sort by: Price: High to Low
                $order = '`price` DESC';
            } else if($sort==3) { //Sort by: Quantity: Low to High
                $order = '`qty` ASC';
            } else if($sort==4) { //Sort by: Quantity: High to Low
                $order = '`qty` DESC';
            }

            // Find Products with pagination
            if(!empty($s) && $c!=0) {
                $rs_pro = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `catagory_id`='".$c."'
                ORDER BY ".$order." LIMIT 6 OFFSET ".$offset.";");
            } else if(!empty($s) && $b!=0) {
                $rs_pro = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s. "%' AND `modle_has_brand_id` 
                    IN(SELECT `id` FROM `model_has_brand` WHERE `brand_id`='".$b."') ORDER BY ".$order." LIMIT 6 OFFSET ".$offset.";");
            } else if(!empty($s) && $m!=0) {
                $rs_pro = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `modle_has_brand_id` 
                    IN(SELECT `id` FROM `model_has_brand` WHERE `model_id`='".$m."') ORDER BY ".$order." LIMIT 6 OFFSET ".$offset.";");
            } else if(!empty($s) && $con!=0) {
                $rs_pro = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `condition_id`='".$con."'
                ORDER BY ".$order." LIMIT 6 OFFSET ".$offset.";");
            } else if(!empty($s) && $col!=0) {
                $rs_pro = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `color_id`='".$col."'
                ORDER BY ".$order." LIMIT 6 OFFSET ".$offset.";");
            } else if(!empty($s) && !empty($pf) && empty($pt)) {
                $rs_pro = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `price`>='".$pf."'
                ORDER BY ".$order." LIMIT 6 OFFSET ".$offset.";");
            } else if(!empty($s) && !empty($pt) && empty($pf)) {
                $rs_pro = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `price`<='".$pt."'
                ORDER BY ".$order." LIMIT 6 OFFSET ".$offset.";");
            } else if(!empty($s) && !empty($pf) && !empty($pt)) {
                $rs_pro = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' AND `price`>='".$pf."' AND `price`<='".$pt."'
                ORDER BY ".$order." LIMIT 6 OFFSET ".$offset.";");
            } else if(!empty($s)) {
                $rs_pro = Database::s("SELECT * FROM `product` WHERE `description`LIKE'%".$s."%' ORDER BY ".$order." LIMIT 6 
                OFFSET ".$offset.";");
            }

            $nr_pro = $rs_pro->num_rows;
            
            if($nr_pro>=1) {
                for($i=0; $i<$nr_pro; $i++) {
                    $pro = $rs_pro->fetch_assoc();

                    $rs_img = Database::s("SELECT * FROM `image` WHERE `product_id`='".$pro['id']."' LIMIT 1;");
                    $nr_img = $rs_img->num_rows;
                    if($nr_img==1) {
                        $img = $rs_img->fetch_assoc();
                        $pro["img"] = $img["code"];
                    } else {
                        $pro["img"] = 'resources/empty.svg';
                    }
                    $array[$i] = $pro;
                }

                // Find Products with pagination



                // Creating page with $array
                // Get the details by array and add it to body, and send the body content to javascript

                // HTML,CSS,Bootstrap,PHP body part
                    for($j=0; $j<$nr_pro; $j++) {
                        ?>
                            <div class="col-10 offset-1 offset-sm-0 col-sm-6 px-3">
                                <div class="row">
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4 mt-4">
                                                <img src="<?php echo $array[$j]["img"]; ?>" class="img-fluid rounded-start" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $array[$j]["title"]; ?></h5>
                                                    <span class="card-text fw-bold text-primary">Rs. <?php echo $array[$j]["price"]; ?>.00</span> <br />
                                                    <span class="card-text fw-bold text-success"><?php echo $array[$j]["qty"]; ?> Items Left</span>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                                                <a href="<?php echo 'singleProductView.php?id=' . $array[$j]['id']; ?>" class="btn btn-success d-grid">Buy Now</a>
                                                            </div>
                                                            <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                                                <a class="btn btn-primary d-grid" onclick="addToCart(<?php echo $array[$j]['id'] ?>);">Add to Cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                    }
                    ?>

                    <!-- Divider beetween body and pagination part: this divider will be used in javascript to split text -->
                    <hr/><hr/><hr/><hr/><hr/>
                    <!-- Divider beetween body and pagination part -->

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                            if($pageno<=1) {
                                ?>
                                    <a>&laquo;</a>
                                <?php
                            } else {
                                ?>
                                    <a onclick="advanceSearch('<?php echo $s; ?>','<?php echo $ss; ?>',<?php echo ($pageno-1); ?>);">&laquo;</a>
                                <?php
                            }
                            
                            for($page = 1; $page <= $number_of_pages; $page++) {
                                if ($page == $pageno) {
                                    ?>
                                        <a onclick="" class="active"><?php echo $page; ?></a>
                                    <?php
                                } else {
                                    ?>
                                        <a onclick="advanceSearch('<?php echo $s; ?>','<?php echo $ss; ?>',<?php echo $page; ?>);"><?php echo $page; ?></a>
                                    <?php
                                }
                            }

                            if($pageno>=$number_of_pages) {
                                ?>
                                    <a>&raquo;</a>
                                <?php
                            } else {
                                ?>
                                    <a onclick="advanceSearch('<?php echo $s; ?>','<?php echo $ss; ?>',<?php echo ($pageno+1); ?>);">&raquo;</a>
                                <?php
                            }
                        ?>
                    </div>
                    <!-- Pagination -->
                <?php
                // HTML,CSS,Bootstrap,PHP body part

                // Creating page with $array

            } else {
                echo "no";
            }

        }
    } else {
        echo "empty";
    }


?>