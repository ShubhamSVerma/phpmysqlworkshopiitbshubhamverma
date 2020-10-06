<?php
    if(isset($_POST['md5'])){
        if($_POST['input']){
            $md5 = "Result after apllying MD5 Algorithm: ".md5($_POST['input']);
        }
        if($_POST['file']){
            $md5_file = "After applying MD5 Algorithm on file: ".md5_file($_POST['file']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD5</title>
</head>
<body>
    <form method="post">
        <label for="input">Input Text: </label>
        <input type="text" id="input" name="input"><br><br>
        <label for="file">Select File: </label>
        <input type="file" name="file" id="file"><br><br>
        <input type="submit" value="Applyy MD5" name="md5"><br><br>
        <?php 
            if(isset($md5)){
                echo $md5;
                echo "<br>";
            }
            if(isset($md5_file)){
                echo $md5_file;
            } 
        ?>
    </form>
</body>
</html>