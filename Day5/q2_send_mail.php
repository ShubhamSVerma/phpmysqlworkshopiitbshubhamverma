<?php
    if(isset($_POST['send'])){
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['msg'])){
            $name = $_POST['name'];
            $user_email = $_POST['email'];
            $feedback = $_POST['msg'];
            if(mail($user_email,'Feedback Form','Thank you for giving your time and filling our feedback form.')){
                echo "Thank you form your feedback.";
            };
            $owner_msg = "Name:$name\nEmail:$user_email\nFeedback:$feedback";
            mail('shubhamsv01@gmail.com','New Feedback',$owner_msg);
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
        <label for="name">Name: </label>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email: </label>
        <input type="email" id="email" name="email"><br><br>
        <label for="msg">Feedback: </label>
        <textarea name="msg" id="msg" cols="30" rows="5"></textarea><br><br>
        <input type="submit" value="Send" name="send">
    </form>
</body>
</html>