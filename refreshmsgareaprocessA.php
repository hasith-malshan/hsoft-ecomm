<?php

session_start();

require "connection.php";

if (isset($_SESSION["a"])) {

    $recever = $_POST["e"];

    ///*if(isset($_POST["ad"])) {
    //$sender = $_SESSION["a"]["email"];
    //} else {
    $sender = $_SESSION["a"]["email"];
    //}*/

 

    // echo $sender."\n".$recever;

    // $senderrs = Database::s("SELECT * FROM `chat` WHERE `from`='" . $sender . "' OR `to`='" . $sender . "'");

    $senderrs = Database::s("SELECT * FROM `chat` WHERE (`from`='" . $sender . "' AND `to`='" . $recever . "') OR (`to`='" . $sender . "' AND `from`='" . $recever . "') ORDER BY `date` ASC;");

    $n = $senderrs->num_rows;

    if ($n == 0) {
?>

        <!-- empty message -->
        <div class="col-12 mb-3 text-center">
            <div class="msgbodyimg"></div>
            <p class="fs-4 mt-3 fw-bold text-black-50">No Messages To Show.</p>
        </div>
        <!-- empty message -->

        <?php
    } else {
        for ($x = 0; $x < $n; $x++) {
            //echo $sender;
            $f = $senderrs->fetch_assoc();

            $fdatetime = $f["date"];
            $datetime = explode(" ", $fdatetime);
            $ctime = date("g:i a", strtotime($datetime[1]));
            $date = $datetime[0];

            if ($f["from"] == $sender) {
        ?>
                <!-- Reciever Message-->

                <div class="col-5"></div>
                <div class="col-7 media ml-auto mb-1">
                    <div class="media-body">
                        <div class="bg-primary rounded py-2  px-1 px-md-3 mb-1" style="overflow-wrap: break-word;">
                            <p class="text-small mb-0 text-white"><?php echo $f["content"]; ?></p>
                        </div>
                        <p class="small text-muted"><?php echo $ctime . " | " . $date; ?> <?php echo "---" . $f["id"]; ?></p>
                    </div>
                </div>
                <!-- Reciever Message -->

            <?php
            } else {
            ?>

                <!-- sender message -->
                <div class="col-7 media mb-1">
                    <img src="resources/demoProfileImg.jpg" alt="user" width="50px" height="50px" class="rounded-circle">
                    <div class="media-body ml-3">
                        <div class="bg-light rounded py-2 px-1 px-md-3 mb-1" style="overflow-wrap: break-word;">
                            <p class="text-small mb-0 text-muted"><?php echo $f["content"]; ?></p>
                        </div>
                        <p class="small text-muted"><?php echo $ctime . " | " . $date; ?></p>
                    </div>
                </div>
                <div class="col-5"></div>
                <!-- sender message -->

<?php
            }
        }
    }
}

?>