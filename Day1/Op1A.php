<?php
    $num1 = 13;
    $num2 = 15;
    $arr = array("Addition of $num1+$num2="=>$num1+$num2,"Subtraction of $num1-$num2="=>$num1-$num2,"Multiplication of $num1*$num2="=>$num1*$num2,"Division of $num1/$num2="=>$num1/$num2);
    foreach($arr as $operation=>$result){
        echo "$operation"."$result<br>";
    }
?>