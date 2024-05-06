<?php
$from = $_GET["f"];
$to = $_GET["t"];

if (empty($from)) {
    echo "1";
} else if (empty($to)) {
    echo "2";
} else if ($from > $to) {
    echo "3";
} else {
 "000";
}
