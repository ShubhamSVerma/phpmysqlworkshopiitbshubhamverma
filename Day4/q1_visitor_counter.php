<?php
    require("connect.php");
    $fetched = $conn->query("SELECT counter FROM visitor_count");
    $counter = $fetched->fetch_assoc();
    $count = $counter['counter'];
    $count += 1;
    print_r("Total visitors: ".$count);
    $write = $conn->query("UPDATE visitor_count SET counter=$count");
?>