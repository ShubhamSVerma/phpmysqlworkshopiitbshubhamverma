<?php
    $triangle = "";
    if($_SERVER['REQUEST_METHOD']=="GET"){
        if(isset($_GET["first_side"]) && isset($_GET["second_side"]) && isset($_GET["third_side"])){
            $first = $_GET["first_side"];
            $second = $_GET["second_side"];
            $third = $_GET["third_side"];
            if($first==$second && $second==$third){
                $triangle = "Equilateral";
            }
            elseif($first==$second && $second!=$third){
                $triangle = "Isosceles";
            }
            elseif($first==$third && $first!=$second){
                $triangle = "Isosceles";
            }
            elseif($second==$third && $first!=$second){
                $triangle = "Isosceles";
            }
            elseif($first!=$second && $second!=$third){
                $triangle = "Scalene";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Special Variables and PHP and HTML</title>
</head>
<body>
    <form method="GET">
        <label for="Side1">Side 1</label>
        <input type="number" name="first_side" id="Side1">
        <label for="Side2">Side 2</label>
        <input type="number" name="second_side" id="Side2">
        <label for="Side3">Side 3</label>
        <input type="number"  name="third_side" id="Side3">
        <input type="submit" value="Submit">
    </form>
    <p><?php echo "The triangle is $triangle" ?></p>
</body>
</html>