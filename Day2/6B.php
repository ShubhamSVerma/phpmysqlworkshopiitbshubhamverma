<?php
    $name = $m1 = $m2 = $m3 = $m4 = $m5 = $total =$out_off = $percentage = '';
    $namec = $mc1 = $mc2 = $mc3 = $mc4 = $mc5 = $totalc = $percentagec = '';
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['user-name']) && isset($_POST['marks1']) &&  isset($_POST['marks2']) && isset($_POST['marks3']) && isset($_POST['marks4']) && isset($_POST['marks5'])){
            $namec = $_POST['user-name'];
            $mc1 = $_POST['marks1'];
            $mc2 = $_POST['marks2'];
            $mc3 = $_POST['marks3'];
            $mc4 = $_POST['marks4'];
            $mc5 = $_POST['marks5'];
            $name = "Name of Student: $namec<br>";
            $m1 = "Marks in Each Subject<br>Subject 1: $mc1<br>";
            $m2 = "Subject 2: $mc2<br>";
            $m3 = "Subject 3: $mc3<br>";
            $m4 = "Subject 4: $mc4<br>";
            $m5 = "Subject 5: $mc5<br>";
            $totalc = $mc1+$mc2+$mc3+$mc4+$mc5;
            $total = "Total Marks obbtained: $totalc<br>";
            $out_off = "Total marks: 600<br>";
            $percentagec = (($mc1+$mc2+$mc3+$mc4+$mc5)/500)*100;
            $percentage = "Percentage: $percentagec%<br>";
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
    <form method="POST">
        <label for="user">Username: </label>
        <input type="text" name="user-name" id="user"><br><br>
        <label for="mark1">Marks 1: </label>
        <input type="number" name="marks1" id="mark1"><br><br>
        <label for="mark2">Marks 2: </label>
        <input type="number" name="marks2" id="mark2"><br><br>
        <label for="mark3">Marks 3: </label>
        <input type="number" name="marks3" id="mark3"><br><br>
        <label for="mark4">Marks 4: </label>
        <input type="number" name="marks4" id="mark4"><br><br>
        <label for="mark5">Marks 5: </label>
        <input type="number" name="marks5" id="mark5"><br><br>
        <input type="submit" value="Submit">
    </form>
    <?php
        echo "<br>";
        echo $name;
        echo $m1;
        echo $m2;
        echo $m3;
        echo $m4;
        echo $m5;
        echo $total;
        echo $out_off;
        echo $percentage;
    ?>
</body>
</html>