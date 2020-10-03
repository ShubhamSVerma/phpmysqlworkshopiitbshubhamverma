<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="file">Select File: </label>
        <input type="file" name="inp_file" id="file"><br><br>
        <input type="submit" value="Submit" name="submit"><br><br>
    </form>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        echo "File name: ".basename($_FILES["inp_file"]['name'])."<br>";
        echo "File extension: ".strtolower(pathinfo("upload/".$_FILES["inp_file"]['name'],PATHINFO_EXTENSION))."<br>";
        echo "File size: ".$_FILES["inp_file"]['size']."Bytes<br>";
        print_r("File type: ".getimagesize($_FILES["inp_file"]['tmp_name'])['mime']);
    }
?>