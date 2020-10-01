<?php
    $number1 = 21;
    $number2 = 20;
    while($number2!=23){
        if($number1<$number2){
            echo "$number1 is less than $number2.<br>";
            $number2++;
        }elseif($number1==$number2){
            echo "$number1 is equal to $number2.<br>";
            $number2++;
        }else{
            echo "$number1 is greater than $number2.<br>";
            $number2++;
        }
    }
?>