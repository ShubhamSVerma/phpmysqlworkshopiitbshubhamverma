<?php
    $conn = new  mysqli('localhost','root','','result');
    if(isset($_POST['md5'])){
        if($_POST['user'] && $_POST['pass']){
            $user = $_POST['user'];
            $md5_pass = md5($_POST['pass']);
            $sql = $conn->prepare("INSERT into data1(user,pass) values(?,?)");
            $sql->bind_param('ss',$user,$md5_pass);
            if($sql->execute()){
                $success = "Insert complete.";
            }
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
        <label for="input">Username: </label>
        <input type="text" id="input" name="user"><br><br>
        <label for="file">Password: </label>
        <input type="password" name="pass" id="file"><br><br>
        <input type="submit" value="Login" name="md5"><br><br>
        <?php 
            if(isset($success)){
                echo $success;
                echo "<br>";
            }
        ?>
    </form>
</body>
</html>