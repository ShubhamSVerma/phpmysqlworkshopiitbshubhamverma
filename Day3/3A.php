<?php
    require("connect.php");
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['user-name']) && isset($_POST['marks1']) &&  isset($_POST['marks2']) && isset($_POST['marks3']) && isset($_POST['marks4']) && isset($_POST['marks5'])){
            $total_obtained = $_POST["marks1"]+$_POST["marks2"]+$_POST["marks3"]+$_POST["marks4"]+$_POST["marks5"];
            $total_marks = 500;
            $percent = ($total_obtained/$total_marks)*100;
            $result = $conn->prepare("INSERT into class1(name,sub1,sub2,sub3,sub4,sub5,total_obtained,total_marks,percent) values(?,?,?,?,?,?,?,?,?)");
            $result->bind_param('sssssssss',$_POST["user-name"],$_POST["marks1"],$_POST["marks2"],$_POST["marks3"],$_POST["marks4"],$_POST["marks5"],$total_obtained,$total_marks,$percent);
            $result->execute();
            sleep(2);
            $fet_data = $conn->prepare("SELECT * FROM class1 WHERE name=?");
            $fet_data->bind_param('s',$_POST["user-name"]);
            $fet_data->execute();
            $form = $fet_data->get_result();
            echo "<pre>\n";
            while($value=$form->fetch_assoc()){
                echo "Name of Student: ";
                echo $value['name']."<br>";
                echo "Marks in Each Subject<br>";
                echo "Subject 1: ";
                echo $value['sub1']."<br>";
                echo "Subject 2: ";
                echo $value['sub2']."<br>";
                echo "Subject 3: ";
                echo $value['sub3']."<br>";
                echo "Subject 4: ";
                echo $value['sub4']."<br>";
                echo "Subject 5: ";
                echo $value['sub5']."<br>";
                echo "Total marks Obtained: ";
                echo $value['total_obtained']."<br>";
                echo "Total Marks: ";
                echo $value['total_marks']."<br>";
                echo "Percentage: ";
                echo $value['percent']."%<br>";
            }
            echo "</pre>";
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
        <input type="text" name="user-name" id="user" required><br><br>
        <label for="mark1">Marks 1: </label>
        <input type="number" name="marks1" id="mark1" required><br><br>
        <label for="mark2">Marks 2: </label>
        <input type="number" name="marks2" id="mark2" required><br><br>
        <label for="mark3">Marks 3: </label>
        <input type="number" name="marks3" id="mark3" required><br><br>
        <label for="mark4">Marks 4: </label>
        <input type="number" name="marks4" id="mark4" required><br><br>
        <label for="mark5">Marks 5: </label>
        <input type="number" name="marks5" id="mark5" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>