<?php
    $mat1 = array(array(12,14),array(31,45));
    $mat2 = array(array(33,11),array(9,17));
    print_r("First matrix :");
    print_r($mat1);
    echo "<br>";
    print_r("Second matrix :");
    print_r($mat2);
    echo "<br>";
    $sum = array();
    foreach($mat1 as $row1){
        foreach($mat2 as $row2){
            array_push($sum,array($row1[0]+$row2[0],$row1[1]+$row2[1]));
            unset($mat2[0]);
            break;
        }
    }
    echo "Sum of above two matrix is :";
    print_r($sum);
?>