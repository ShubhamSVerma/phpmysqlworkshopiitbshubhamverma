<?php
    require "connect.php";
    session_start();
    $user = $_SESSION['admin'];
    if($user==''){
        header("Location:login_admin.php");
    }else{
        if(isset($_POST['add'])){
            if(isset($_POST['email']) && isset($_POST['php']) && isset($_POST['mysql']) && isset($_POST['html'])){
                $sql_check = "SELECT student_email from admin_student where student_email=?";
                $sql_check_prep = $conn->prepare($sql_check);
                $sql_check_prep->bind_param('s',$_POST['email']);
                $sql_check_prep->execute();
                $sql_check_get = $sql_check_prep->get_result();
                $sql_check_email = $sql_check_get->fetch_assoc();
                if(!empty($sql_check_email['student_email'])){
                    $return = "<p style='color:red;font-size:1.5rem;margin:1rem;'>Record already exists please use Update section to update records.</p>";
                }
                else{
                    $sql = "INSERT INTO `admin_student`(`student_email`, `PHP`, `MySQL`, `HTML`, `total_obtained`, `total`, `percent`, `Status`) VALUES (?,?,?,?,?,?,?,?)";
                    $sql_prep = $conn->prepare($sql);
                    $total_obt = $_POST['php'] + $_POST['mysql'] + $_POST['html'];
                    $total = 300;
                    $percent = ($total_obt/$total)*100;
                    if($percent>=60){
                        $status = "PASS";
                    }else{
                        $status = "FAIL";
                    }
                    $sql_prep->bind_param('ssssssss',$_POST['email'],$_POST['php'],$_POST['mysql'],$_POST['html'],$total_obt,$total,$percent,$status);
                    if($sql_prep->execute()){
                        $return = "<p style='color:green;font-size:1.5rem;margin:1rem;'>New record has been added.</p>";
                    }else{
                        $return = "<p style='color:red;font-size:1.5rem;margin:1rem;'>Unable to add record.</p>";
                        echo $conn->error;
                    }
                }
            }
        }
        if(isset($_POST['del'])){
            if(isset($_POST['del_email'])){
                $sql = "DELETE FROM `admin_student` WHERE student_email=? LIMIT 1";
                $sql_prep = $conn->prepare($sql);
                $sql_prep->bind_param('s',$_POST['del_email']);
                $sql_n = "DELETE FROM `student` WHERE email=? LIMIT 1";
                $sql_prep_n = $conn->prepare($sql_n);
                $sql_prep_n->bind_param('s',$_POST['del_email']);
                if($sql_prep_n->execute() && $sql_prep->execute()){
                    $return = "<p style='color:green;font-size:1.5rem;margin:1rem;'>Record deleted successfully.</p>";
                }else{
                    $return = "<p style='color:red;font-size:1.5rem;margin:1rem;'>Unable to delete record.</p>";
                    echo $conn->error;
                }
            }
        }
        if(isset($_POST['update'])){
            if(isset($_POST['upd_email']) && isset($_POST['upd_php']) && isset($_POST['upd_mysql']) && isset($_POST['upd_html'])){
                $sql_check = "SELECT student_email from admin_student where student_email=?";
                $sql_check_prep = $conn->prepare($sql_check);
                $sql_check_prep->bind_param('s',$_POST['upd_email']);
                $sql_check_prep->execute();
                $sql_check_get = $sql_check_prep->get_result();
                $sql_check_email = $sql_check_get->fetch_assoc();
                if(empty($sql_check_email['student_email'])){
                    $sql = "INSERT INTO `admin_student`(`student_email`, `PHP`, `MySQL`, `HTML`, `total_obtained`, `total`, `percent`, `Status`) VALUES (?,?,?,?,?,?,?,?)";
                    $sql_prep = $conn->prepare($sql);
                    $total_obt = $_POST['upd_php'] + $_POST['upd_mysql'] + $_POST['upd_html'];
                    $total = 300;
                    $percent = ($total_obt/$total)*100;
                    if($percent>=60){
                        $status = "PASS";
                    }else{
                        $status = "FAIL";
                    }
                    $sql_prep->bind_param('ssssssss',$_POST['upd_email'],$_POST['upd_php'],$_POST['upd_mysql'],$_POST['upd_html'],$total_obt,$total,$percent,$status);
                    if($sql_prep->execute()){
                        $return = "<p style='color:green;font-size:1.5rem;margin:1rem;'>Updated successfully.</p>";
                    }else{
                        $return = "<p style='color:red;font-size:1.5rem;margin:1rem;'>Updation failed.</p>";
                        echo $conn->error;
                    }
                }
                else{
                    $sql = "UPDATE admin_student set student_email=?,PHP=?,MySQL=?,HTML=?,total_obtained=?,total=?,percent=?,Status=? where student_email=?";
                    $sql_prep = $conn->prepare($sql);
                    $total_obt = $_POST['upd_php'] + $_POST['upd_mysql'] + $_POST['upd_html'];
                    $total = 300;
                    $percent = ($total_obt/$total)*100;
                    if($percent>=60){
                        $status = "PASS";
                    }else{
                        $status = "FAIL";
                    }
                    $sql_prep->bind_param('sssssssss',$_POST['upd_email'],$_POST['upd_php'],$_POST['upd_mysql'],$_POST['upd_html'],$total_obt,$total,$percent,$status,$_POST['upd_email']);
                    if($sql_prep->execute()){
                        $return = "<p style='color:green;font-size:1.5rem;margin:1rem;'>Updated successfully.</p>";
                    }else{
                        $return = "<p style='color:red;font-size:1.5rem;margin:1rem;'>Updation failed.</p>";
                        echo $conn->error;
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        /* main {
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        } */
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
            margin: 1rem 0 0 1rem;
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
        table{
            border-collapse: collapse;
            background-color: rgba(0,0,0,0.1);
        }
        /* table > caption{
            margin-bottom: 1rem;
            font-size: 2rem;
            font-weight: bold;
            background: radial-gradient(black, grey, black);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        } */
        table,td,thead,th{
            padding: 0 0.5rem 0 0.5rem;
            border: 2px solid black;
            font-size: 1rem;
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
        div.toggel{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border: 2px solid black;
            border-radius: 10px;
            padding: 1rem 1rem;
            overflow: auto;
            /* margin-left: 50%;
            transform:translateX(-50%);  */
        }
        div#record{
            display: block;
        }
        div#add{
            display: none;
        }
        div#remove{
            display: none;
        }
        div#update{
            display: none;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <span class="logo">Mini Mini Project</span>
        <span class="user"><?php 
        if(isset($user)){
            echo 'Admin'; 
        }
        ?></span>
        <nav class="navigation">
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <button class="record" onclick="record()">Record</button>
        <button class="add" onclick="add()">Add</button>
        <button class="remove" onclick="remove()">Remove</button>
        <button class="update" onclick="update()">Update</button>
        <div class="toggel">
            <div id="record">
                <table>
                    <caption>
                    <?php 
                        if(isset($return)){
                            echo $return;
                        }
                    ?>
                    </caption>
                    <thead> 
                        <th>Username</th>
                        <th>Account Email</th>
                        <th>Password</th>
                        <th>College Email</th>
                        <th>PHP</th>
                        <th>MySQL</th>
                        <th>HTML</th>
                        <th>Final Score</th>
                        <th>Percentage</th>
                        <th>Status</th>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM student LEFT JOIN admin_student ON student.email = admin_student.student_email UNION SELECT * FROM student RIGHT JOIN admin_student ON student.email = admin_student.student_email ORDER BY id";
                        $sql_prep = $conn->prepare($sql);
                        $sql_prep->execute();
                        $sql_get = $sql_prep->get_result();
                        while($row=$sql_get->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php if(empty(!$row['username'])){ echo $row['username'];}else{echo "Account does not exists";} ?></td>
                        <td><?php if(empty(!$row['email'])){ echo $row['email'];}else{echo "Account does not exists";} ?></td>
                        <td><?php if(empty(!$row['pass_word'])){ echo $row['pass_word'];}else{echo "Account does not exists";} ?></td>
                        <td><?php if(empty(!$row['student_email'])){ echo $row['student_email'];}else{echo "No record";} ?></td>
                        <td><?php if(empty(!$row['PHP'])){ echo $row['PHP'];}else{echo "No record";} ?></td>
                        <td><?php if(empty(!$row['MySQL'])){ echo $row['MySQL'];}else{echo "No record";} ?></td>
                        <td><?php if(empty(!$row['HTML'])){ echo $row['HTML'];}else{echo "No record";} ?></td>
                        <td><?php if(empty(!$row['total_obtained'])){ echo $row['total_obtained'].'/300';}else{echo "No record";} ?></td>
                        <td><?php if(empty(!$row['percent'])){ echo $row['percent'];}else{echo "No record";} ?></td>
                        <td><?php if(empty(!$row['Status'])){ echo $row['Status'];}else{echo "No record";} ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <div id="add">
                <form method="post">
                    <label for="email">Email: </label>
                    <input type="text" id="email" name="email" required><br><br>
                    <label for="php">PHP: </label>
                    <input type="number" id="php" name="php" size="20" min="0" max="100" required><br><br>
                    <label for="mysql">MySQL: </label>
                    <input type="number" id="mysql" name="mysql" size="20" min="0" max="100" required><br><br>
                    <label for="html">HTML: </label>
                    <input type="number" id="html" name="html" size="20" min="0" max="100" required><br><br>
                    <button type="submit" name="add">Add</button>
                </form>
            </div>
            <div id="remove">
                <form method="post">
                    <label for="del_email">Email: </label>
                    <input type="text" id="del_email" name="del_email" required><br><br>
                    <button type="submit" name="del">Delete</button>
                </form>
            </div>
            <div id="update">
                <form method="post">
                    <label for="upd_email">Email: </label>
                    <input type="text" id="upd_email" name="upd_email" required><br><br>
                    <label for="upd_php">PHP: </label>
                    <input type="number" id="upd_php" name="upd_php" size="20" min="0" max="100" required><br><br>
                    <label for="upd_mysql">MySQL: </label>
                    <input type="number" id="upd_mysql" name="upd_mysql" size="20" min="0" max="100" required><br><br>
                    <label for="upd_html">HTML: </label>
                    <input type="number" id="upd_html" name="upd_html" size="20" min="0" max="100" required><br><br>
                    <button type="submit" name="update">Update</button>
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    function record(){
        document.getElementById("record").style.display = "block";
        document.getElementById("add").style.display = "none";
        document.getElementById("remove").style.display = "none";
        document.getElementById("update").style.display = "none";
    }
    function add(){
        document.getElementById("record").style.display = "none";
        document.getElementById("add").style.display = "block";
        document.getElementById("remove").style.display = "none";
        document.getElementById("update").style.display = "none";
    }
    function remove(){
        document.getElementById("record").style.display = "none";
        document.getElementById("add").style.display = "none";
        document.getElementById("remove").style.display = "block";
        document.getElementById("update").style.display = "none";
    }
    function update(){
        document.getElementById("record").style.display = "none";
        document.getElementById("add").style.display = "none";
        document.getElementById("remove").style.display = "none";
        document.getElementById("update").style.display = "block";
    }
</script>
</html>