<?php
    $number_arr = array(11,23,72,44);
    foreach($number_arr as $number){
        if($number%2==0){
            echo "$number is even.<br>";
        }else{
            echo "$number is odd.<br>";
        }
    }
?>