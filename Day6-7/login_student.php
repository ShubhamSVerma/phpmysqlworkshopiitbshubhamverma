<?php
    require "connect.php";
    if(isset($_POST['submit'])){
        if(isset($_POST['user']) && isset($_POST['password'])){
            $sql = "SELECT * FROM `student` where username=? and pass_word=?";
            $sql_pre = $conn->prepare($sql);
            $sql_pre->bind_param("ss",$_POST['user'],$_POST['password']);
            $sql_pre->execute();
            $sql_fetch = $sql_pre->get_result();
            $data = $sql_fetch->fetch_assoc();
            if(isset($data['username']) && isset($data['pass_word'])){
                if($data['username']==$_POST['user'] && $data['pass_word']==$_POST['password']){
                    session_start();
                    $_SESSION['user'] = $_POST['user'];
                    header("Location:home_student.php");
                }
            }else{
                $status = "<p style='color:red;font-size:1.5rem;margin:1rem;'>Username or Password is incorrect.</p>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login As Student</title>
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
        margin: 1rem 2rem 0 auto;
        }
        header span.logo {
        pointer-events:none;
        flex: 1;
        font-size: 2rem;
        font-weight: bolder;
        margin: 0.5rem 0 0.2rem 2rem;
        background: radial-gradient(black, grey, black);
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
            background-color: black;
            color: white;
            border-radius: 3rem;
            padding: 1rem;
            line-height: 0.2rem;
            transition: all 0.5s ease-in;
            outline: none;
        }
        button:hover{
            background-color: white;
            color: black;
            transition: all 0.5s ease-in;           
        }
    </style>
</head>
<body>
    <header>
        <span class="logo">Mini Mini Project</span>
        <nav class="navigation">
            <ul>
                <li><a href="register.php">Login As Student</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form method="post">
            <label for="username">Username: </label>
            <input type="text" id="username" name="user" required><br><br>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit" name="submit">Login</button>
            <?php 
                if(isset($status)){
                    echo $status;
                }
            ?>
        </form>
    </main>
</body>
</html>