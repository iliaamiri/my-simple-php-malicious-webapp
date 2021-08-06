<?php include"../../config.php";
$connection = mysqli_connect($host,$user,$pass)or die("Error in connect via Sqli");
mysqli_select_db($connection,$db);
$sqlfnc = mysqli_query($connection,"SELECT cookie FROM user WHERE id='1'");
$database = mysqli_fetch_assoc($sqlfnc);
if (isset($_SESSION['name'])){
    if (!$_COOKIE['admin']){
        session_destroy('name');
        header("location:../../index.php?err");
    }
    elseif (isset($_COOKIE['admin'])){
        if ($_COOKIE['admin']!=$database['cookie']){
            session_destroy();
            header("location:../../index.php?err");
        }
    }
}
elseif (!isset($_SESSION['name'])){
    header("location:../../index.php?errr");
}
if (isset($_POST['upload'])){
    $title = $_POST['title'];
    @$file=$_FILES['file'];
    if (!preg_match("/^[a-zA-Z0-9+@.]*$/",$title)){
        header("location:index.php?letters_t");
    }
    else{
        if ($_FILES['file']['error'] > 0){
            header("location:index.php?error");
        }
        else{
            if ($_COOKIE['admin']!=$database['cookie']){
                session_destroy();
            }
            elseif ($_COOKIE['admin']==$database['cookie']){
                $name=$file['name'];
                $a=explode(".",$name);
                $end=end($a);
                $newname=$title."-file".".".$end;
                $to="uploaded/".$newname;
                $from=$file['tmp_name'];
                move_uploaded_file($from,$to);
                $url = "uploaded"."/".$newname;
                try{
                    $conn= new PDO("mysql:host=$host;dbname=$db",$user,$pass);
                    $sql=$conn->prepare("INSERT INTO upload_tbl (title,url,endd) VALUE ('$title','$url','$end')");
                    $sql->execute();
                }
                catch(PDOException $e){
                    header("location:index.php?ERROR_SEND");
                }
            }

        }

    }
}
/*$connn = mysqli_connect($host,$user,$pass)or die(mysqli_error());
mysqli_select_db($connn,$db);
$sql1=mysqli_query($connn,"SELECT * FROM uploud_tbl");*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Upload File</title>
    <link rel="icon" href="../../img/icon.gif" type="image/gif" sizes="16x16">
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/style.css" type="text/css" rel="stylesheet">
    <!-- <link href="css/main.css" type="text/css" rel="stylesheet">-->
    <link href="../../css/login.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<table>
    <form method="post" enctype="multipart/form-data" class="login-form">
        <div class="container">
            <div class="row lgpage-bg">
                <div class="col-md-4 col-md-push-4 form-box">
                    <div class="row">
                        <div class="login-page">
                            <div class="form">
                                <input type="file" class="input" name="file"/>
                                <input type="text" placeholder="Title" class="input" name="title"/>
                                <input type="submit" value="Upload" class="login" name="upload"/>
                                <a href="list.php" class="btn btn-custom btn-primary">LIST</a>
                                <a href="../" class="btn btn-custom btn-primary">BACK</a>
                                <input type="submit" class="input-custom" value="LOGOUT" name="logout">
                                <?php
                                 if (isset($_POST['logout']))
                                     session_destroy();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</table>
</body>
</html>

