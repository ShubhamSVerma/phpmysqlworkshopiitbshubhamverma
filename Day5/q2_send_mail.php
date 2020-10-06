<?php
    if(isset($_POST['send'])){
        if(isset($_POST['recipent']) && isset($_POST['sub']) && isset($_POST['msg'])){
            $to = $_POST['recipent'];
            $sub = $_POST['sub'];
            $msg = $_POST['msg'];
            mail($to,$sub,$msg);
       } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Mail</title>
</head>
<body>
    <form method="post">
        <label for="recipent">To: </label>
        <input type="email" id="recipent" name="recipent"><br><br>
        <label for="sub">Subject: </label>
        <input type="text" id="sub" name="sub"><br><br>
        <label for="msg">Message: </label>
        <input type="text" id="msg" name="msg"><br><br>
        <input type="submit" value="Send" name="send">
    </form>
</body>
</html>