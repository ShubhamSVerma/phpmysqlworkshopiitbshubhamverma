<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>String Function</title>
</head>
<body>
    <form action="" method="POST">
        <label for="string">Enter string: </label>
        <input type="text" id="string" name="str_inp" required><br><br>
        <label for="substring">Enter sub-string: </label>
        <input type="text" id="substring" name="sub_str_inp" required><br><br>
        <label for="replace">Enter string which will replace above entered sub-string: </label>
        <input type="text" id="replace" name="rep_str_inp" required><br><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>
<?php
    if(isset($_POST['submit'])){
        $str = $_POST['str_inp'];
        $sub_str = $_POST['sub_str_inp'];
        $rep = $_POST['rep_str_inp'];
        $str_arr = array();
        echo "Number of characters in input string '$str' are". strlen($str) ."<br><br>";
        print_r("String into array: ");
        print_r(str_split($str));
        echo "<br><br>";
        echo "Reverse of the input string '$str' is: " . strrev($str)."<br><br>";
        echo "Lowercase: " . strtolower($str)."<br><br>";
        echo "Uppercase: " . strtoupper($str)."<br><br>";
        if($sub_str===$rep){
            if($str===str_replace($sub_str,$rep,$str)){
                echo "Your entered substring '$sub_str' and replace string '$rep' are similar.<br><br>";
            }
        }elseif($str===str_replace($sub_str,$rep,$str)){
            echo "Your entered sub-strnig '$sub_str' is not present in original string '$str'<br><br>";
        }
        echo "Replaced sub-string '$sub_str' by '$rep' results: " . str_replace($sub_str,$rep,$str)."<br><br>";
    }
?>