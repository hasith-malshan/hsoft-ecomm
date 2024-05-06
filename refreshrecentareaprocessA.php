<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    //if (isset($_POST["ad"])) {
    //  $mail = $_SESSION["a"]["email"];
    //} else {
    $mail = $_SESSION["a"]["email"];
    //}

    $fromMsg = Database::s("SELECT DISTINCT `from` FROM `chat` WHERE `from`!='" . $mail . "' ");

    if ($fromMsg->num_rows > 0) {
        $fromMsgNr = $fromMsg->num_rows;
        $names;
        for ($i = 0; $i < $fromMsgNr; $i++) {
            $fromMsgD = $fromMsg->fetch_assoc();
            $names[$i] = $fromMsgD["from"];
        }

        $sizeName = sizeof($names);

        for ($i = 0; $i < $sizeName; $i++) {

            $chatrs = Database::s("SELECT * FROM `chat` WHERE `from` ='" . $names[$i] . "' AND `to`='" . $mail . "' ORDER BY `id` DESC;");
            $n = $chatrs->num_rows;

            //for ($x = 0; $x < $n; $x++) {
            $r = $chatrs->fetch_assoc();
            $u = array_unique($r);

            $udatetime = explode(" ", $u["date"]);
            $time = date("g:i a", strtotime($udatetime[1]));

            $rs_from = Database::s("SELECT `fname`,`lname` FROM `user` WHERE `email`='" . $u['from'] . "';");
            if ($rs_from->num_rows == 0) {
                $rs_from = Database::s("SELECT `fname`,`lname` FROM `admin` WHERE `email`='" . $u['from'] . "';");
            }

            $from = $rs_from->fetch_assoc();

            if ($i % 2 == 0) {
                $codeC = "bg-dark";
            } else {
                $codeC = "";
            }
            //}

?>


            <?php
            $profileImg = Database::s("SELECT * FROM `profile_img` WHERE `user_email`='" . $u["from"] . "' ; ");
            $n = $profileImg->num_rows;
            $imgData =$profileImg->fetch_assoc();


          

            ?>

            <a class="list-group-item list-group-item-action active text-white rounded-0 <?php echo $codeC ?>" href="messagesA.php?e=<?php echo $r["from"] ?>">
                <div class="media ">
                    <img src="<?php echo $imgData["code"] ?>" alt="user" width="50" class="rounded-circle">
                    <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h6 class="mb-0"><?php echo $from["fname"] . " " . $from["lname"]; ?></h6><small class="small font-weight-bold"><?php echo $time; ?></small>
                        </div>
                        <p class="font-italic mb-0 text-small"><?php echo $u["content"]; ?></p>
                    </div>
                </div>
            </a>



<?php

        }
    }
} else {
    echo "please sign in";
}
?>
































<?php
/*
else if (isset($_SESSION["a"])) {
  
  if(isset($_POST["ad"])) {
      $mail = $_SESSION["a"]["email"];
  } else {
      $mail = $_SESSION["u"]["email"];
  }

  $chatrs = Database::s("SELECT * FROM `chat_a` WHERE `from` NOT IN ('" . $mail . "') AND `to`='".$mail."' ORDER BY `date` DESC LIMIT 1");
  $n = $chatrs->num_rows;

  for ($x = 0; $x < $n; $x++) {
      $r = $chatrs->fetch_assoc();
      $u = array_unique($r);

      $udatetime = explode(" ",$u["date"]);
      $time = date("g:i a", strtotime($udatetime[1]));

      $rs_from = Database::s("SELECT `fname`,`lname` FROM `admin` WHERE `email`='".$u['from']."';");
      $from = $rs_from->fetch_assoc();

      ?>

      <a class="list-group-item list-group-item-action active text-white rounded-0">
          <div class="media">
              <img src="resources/demoProfileImg.jpg" alt="user" width="50" class="rounded-circle">
              <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                      <h6 class="mb-0"><?php echo $from["fname"]." ".$from["lname"]; ?></h6><small class="small font-weight-bold"><?php echo $time; ?></small>
                  </div>
                  <p class="font-italic mb-0 text-small"><?php echo $u["content"]; ?></p>
              </div>
          </div>
      </a>

      <?php
  
*/