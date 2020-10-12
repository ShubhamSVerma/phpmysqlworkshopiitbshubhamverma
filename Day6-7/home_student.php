<?php
    session_start();
    $user = $_SESSION['user'];
    if($user==''){
        header("Location:login_student.php");
    }else{
        require "connect.php";
        $sql = "SELECT PHP,MySQL,HTML,total_obtained,total,percent,Status from admin_student where student_email = (SELECT email from student where username=?)";
        $sql_prep = $conn->prepare($sql);
        $sql_prep->bind_param('s',$user);
        $sql_prep->execute();
        $sql_get = $sql_prep->get_result();
        $sql_fetch = $sql_get->fetch_assoc();
        if(!empty($sql_fetch)){
            $php = $sql_fetch['PHP'];
            $mysql = $sql_fetch['MySQL'];
            $html = $sql_fetch['HTML'];
            $total_obt = $sql_fetch['total_obtained'];
            $total = $sql_fetch['total'];
            $precent = $sql_fetch['percent'];
            $status = $sql_fetch['Status'];
        }
        if(isset($_POST['send'])){
            if(isset($_POST['to']) && isset($_POST['sub']) && isset($_POST['msg'])){
                $user_msg = $_POST['msg'];
                $message = "<table style='border-collapse: collapse;border: 2px solid black;'>
                <caption><?= $user.' Marksheet' ?></caption>
                <thead style='text-align:center;'>
                    <td style='border: 2px solid black;'><b>Subjects</b></td>
                    <td style='border: 2px solid black;'><b>Marks</b></td>
                </thead>
                <tr style='text-align:center;'>
                    <td style='border: 2px solid black;width:150px;'><b>PHP</b></td>
                    <td style='border: 2px solid black;width:150px;'>$php</td>
                </tr>
                <tr style='text-align:center;'>
                    <td style='border: 2px solid black;width:150px;'><b>MySQL</b></td>
                    <td style='border: 2px solid black;width:150px;'>$mysql</td>
                </tr>
                <tr style='text-align:center;'>
                    <td style='border: 2px solid black;width:150px;'><b>HTML</b></td>
                    <td style='border: 2px solid black;width:150px;'>$html</td>
                </tr>
                <tr style='text-align:center;'>
                    <td style='border: 2px solid black;width:150px;'><b>Final Result</b></td>
                    <td style='border: 2px solid black;width:150px;'>$total_obt/$total</td>
                </tr>
                <tr style='text-align:center;'>
                    <td style='border: 2px solid black;width:150px;'><b>Percentage</b></td>
                    <td style='border: 2px solid black;width:150px;'>$precent.'%'</td>
                </tr>
                <tr style='text-align:center;'>
                    <td style='border: 2px solid black;width:150px;'><b>Status</b></td>
                    <td style='border: 2px solid black;width:150px;'>$status</td>
                </tr>
                </table>";
                $message .= "\n$user_msg";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                mail($_POST['to'],$_POST['sub'],$message,$headers);
                $mail_send = "Mail sent successfully.";  
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home Page</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }
        header {
        display: flex;
        box-shadow: 0 2px 5px rgba(0,0,0,0.4);
        }
        header nav {
        margin: 1rem 2rem 0 0;
        }
        header > *{
            flex: 0 0 auto;
        }
        header span.logo {
        /* flex: 1; */
        pointer-events:none;
        font-size: 2rem;
        font-weight: bolder;
        margin: 0.5rem 0 0.2rem 2rem;
        background: radial-gradient(black, grey, black);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        }
        header span.user {
        /* flex: 1; */
        pointer-events:none;
        font-size: 1rem;
        font-weight: bolder;
        line-height:2rem;
        margin: 0.6rem 0 0 0;
        margin-left:auto;
        background: linear-gradient(
        90deg,
        rgba(255, 0, 0, 1) 0%,
        rgba(255, 154, 0, 1) 10%,
        rgba(208, 222, 33, 1) 20%,
        rgba(79, 220, 74, 1) 30%,
        rgba(63, 218, 216, 1) 40%,
        rgba(47, 201, 226, 1) 50%,
        rgba(28, 127, 238, 1) 60%,
        rgba(95, 21, 242, 1) 70%,
        rgba(186, 12, 248, 1) 80%,
        rgba(251, 7, 217, 1) 90%,
        rgba(255, 0, 0, 1) 100%
        );
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        }
        header nav ul {
        line-height: 1rem;
        list-style-type: none;
        }
        header nav ul li {
        display: inline-block;
        margin: 0 1rem;
        }
        header nav ul li a {
        color: black;
        text-decoration: none;
        }
        header nav ul li a::after {
        content: "";
        display: block;
        width: 0;
        background: black;
        height: 1.5px;
        transition: width 1s ease-in;
        }
        header nav ul li a:hover::after {
        width: 100%;
        transition: width 1s ease-in;
        }
        main {
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        }
        input{
            margin:0.3rem;
            outline: 0;
            border-width: 0 0 2px;
            border-color: blue;
            color:rgba(0,0,0,0.7);
        }
        form{
            text-align:center;
            padding:20px;
        }
        button{
            outline: none;
            margin: 1rem 0 0 50%;
            transform:translateX(-50%);
            background-color: black;
            color: white;
            border-radius: 3rem;
            padding: 1rem;
            line-height: 0.2rem;
            transition: all 0.5s ease-in;
        }
        button:hover{
            background-color: white;
            color: black;
            transition: all 0.5s ease-in;           
        }
        table.result{
            border-collapse: collapse;
            background-color: rgba(0,0,0,0.1);
        }
        table.result > caption{
            margin-bottom: 1rem;
            font-size: 2rem;
            font-weight: bold;
            background: radial-gradient(black, grey, black);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        table.result,td,thead{
            width: 500px;
            border: 2px solid black;
            font-size: 1.5rem;
            text-align: center;
            height: 50px;
        }
        thead{
            background-color: rgba(0,0,0,0.05);
        }
        thead td,b{
           background: radial-gradient(black, grey, black);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        p.empty,p.sent{
            margin-top: 1rem;
            text-align:center;
            font-size: 1.5rem;
            background: linear-gradient(
            90deg,
            rgba(255, 0, 0, 1) 0%,
            rgba(255, 154, 0, 1) 10%,
            rgba(208, 222, 33, 1) 20%,
            rgba(79, 220, 74, 1) 30%,
            rgba(63, 218, 216, 1) 40%,
            rgba(47, 201, 226, 1) 50%,
            rgba(28, 127, 238, 1) 60%,
            rgba(95, 21, 242, 1) 70%,
            rgba(186, 12, 248, 1) 80%,
            rgba(251, 7, 217, 1) 90%,
            rgba(255, 0, 0, 1) 100%
            );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 0 0.5px #333);
        }
        p.pass{
            margin-top: 1rem;
            text-align:center;
            font-size: 1.5rem;
            color: green;
            filter: drop-shadow(0 0 0.5px #333);
        }
        p.fail{
            margin-top: 1rem;
            text-align:center;
            font-size: 1.5rem;
            color: red;
            filter: drop-shadow(0 0 0.5px #333);
        }
        div.pop_email{
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border: 2px solid black;
            border-radius: 10px;
            padding: 2rem 2rem;
            width: 400px;
            /* margin-left: 50%;
            transform:translateX(-50%);  */
        }
        div.pop_email button{
            display: inline-block;
            margin-left: 2rem;
        }
    </style>
</head>
<body>
    <header>
        <span class="logo">Mini Mini Project</span>
        <span class="user"><?php 
        if(isset($user)){
            echo $user; 
        }
        ?></span>
        <nav class="navigation">
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <?php if(!empty($sql_fetch)): ?>
        <div class="result_table" id="result_table">
            <table class="result">
                <caption><?= $user." Marksheet" ?></caption>
                <thead>
                    <td><b>Subjects</b></td>
                    <td><b>Marks</b></td>
                </thead>
                <tr>
                    <td><b>PHP</b></td>
                    <td><?= $php?></td>
                </tr>
                <tr>
                    <td><b>MySQL</b></td>
                    <td><?= $mysql?></td>
                </tr>
                <tr>
                    <td><b>HTML</b></td>
                    <td><?= $html?></td>
                </tr>
                <tr>
                    <td><b>Final Result</b></td>
                    <td><?php echo $total_obt.'/'.$total?></td>
                </tr>
                <tr>
                    <td><b>Percentage</b></td>
                    <td><?= $precent.'%'?></td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td><?= $status?></td>
                </tr>
            </table>
            <?php if($status=='PASS'): ?>
            <p class="pass">Congratulations you have passed your exam.</p>
            <?php else: ?>
                <p class="fail">Sorry you failed in exam.</p>
            <?php endif; ?>
            <button id="email" onclick="email()">Mail your marksheet</button>
            <p class='sent'><?php 
            if(isset($mail_send)){
                echo $mail_send;
            } 
            ?></p>
            <?php else: ?>
                <p class='empty'>Your recored is not present.</p>
            <?php endif; ?>
        </div>
            <div class="pop_email" id="pop_email">
                <form method="post">
                    <label for="to">To: </label>
                    <input type="text" name="to" id="to"><br><br>
                    <label for="sub">Subject: </label>
                    <input type="text" name="sub" id="sub"><br><br>
                    <label for="msg">Message: </label>
                    <input type="text" name="msg" id="msg">
                    <button name="send" class="email" onclick="send()">Send</button>
                    <button name="cancel" class="cancel" onclick="cancel()">Cancel</button>
                </form>
            </div>
    </main>
    <script>
        function email() {
        document.getElementById("result_table").style.display = "none";
        document.getElementById("pop_email").style.display = "block";
        }
        function send(){
            document.getElementById("result_table").style.display = "block";
            document.getElementById("pop_email").style.display = "none";
        }
        function cancel(){
            document.getElementById("result_table").style.display = "block";
            document.getElementById("pop_email").style.display = "none";
        }
    </script>
</body>
</html>