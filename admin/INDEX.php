<?php include "../config.php";
$connection = mysqli_connect($host,$user,$pass)or die("Error in connect via Sqli");
mysqli_select_db($connection,$db);
$sqlfnc = mysqli_query($connection,"SELECT cookie FROM user WHERE id='1'");
$database = mysqli_fetch_assoc($sqlfnc);
if (isset($_SESSION['name'])){
    if (!$_COOKIE['admin']){
        session_destroy('name');
        header("location:../index.php?err");
    }
    elseif (isset($_COOKIE['admin'])){
        if ($_COOKIE['admin']!=$database['cookie']){
            session_destroy();
            header("location:../index.php?err");
        }
    }
}
elseif (!isset($_SESSION['name'])){
    session_destroy('name');
    header("location:../INDEX.php?errr");
}
$connn = mysqli_connect($host,$user,$pass)or die("Error in connect via Sqli");
mysqli_select_db($connn,$db);
$sqllimit = mysqli_query($connn,"SELECT log FROM user WHERE id='1'");
$rowlimit = mysqli_fetch_assoc($sqllimit);
if (isset($_POST['send'])){
    @$username = $_POST['username'];
    @$name = $_POST['name'];
    @$lastname = $_POST['lastname'];
    @$ip = $_POST['ip'];
    @$description = $_POST['description'];
    @$kind = $_POST['kind'];
    if (!preg_match("/^[a-zA-Z]*$/",$name)){
        header("location:INDEX.php?letters");
    }
    elseif (!preg_match("/^[a-zA-Z]*$/",$lastname)){
        header("location:INDEX.php?letters");
    }
    elseif (!preg_match("/^[a-zA-Z0-9_.@]*$/",$username)){
        header("location:INDEX.php?letters");
    }
    elseif (!preg_match("/^[a-zA-Z0-9_.@]*$/",$password)){
        header("location:INDEX.php?letters");
    }
    elseif (!preg_match("/^[0-9.]*$/",$ip)){
        header("location:INDEX.php?letters");
    }
    elseif (!preg_match("/^[a-zA-Z0-9_.@_]*$/",$description)){
        header("location:INDEX.php?letters");
    }
    elseif (!preg_match("/^[a-zA-Z0-9_.@]*$/",$kind)){
        header("location:INDEX.php?letters");
    }
    else{
        $password = $_POST['password'];
    try{
        $conn= new PDO("mysql:host=$host;dbname=$db",$user,$pass);
        $sql=$conn->prepare("INSERT INTO user_tbl (namee,lastname,username,password,ip,description,kind) VALUE ('$name','$lastname','$username','$password','$ip','$description','$kind')");
        $sql->execute();
        header("location:index.php?SUCCESS");
    }
    catch (PDOException $e){
        header("location:index.php?ERROR_SEND");
        echo "ERROR" . $e;
    }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Take Form</title>
    <link rel="icon" href="../img/icon.gif" type="image/gif" sizes="16x16">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="css/main.css" type="text/css" rel="stylesheet">-->
    <link href="../css/login.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<table>
    <form method="post" class="login-form">
        <div class="container">
            <div class="row lgpage-bg">
                <div class="col-md-4 col-md-push-4 form-box">
                    <div class="row">
                        <div class="login-page">
                            <div class="form">

                                <input type="text" placeholder="Name" class="input" name="name"/>
                                <input type="text" placeholder="Username" class="input" name="username"/>
                                <input type="text" placeholder="Lastname" class="input" name="lastname"/>
                                <input type="password" placeholder="Password" class="input" name="password"/>
                                <input type="text" placeholder="Ip" class="input" name="ip"/>
                                <input type="text" placeholder="Description" class="input" name="description"/>
                                <input type="text" placeholder="Kind" class="input" name="kind"/>
                                <input type="submit" value="Send" class="login" name="send">
                                <a href="list/index.php" class="btn btn-primary btn-custom">LISTS</a>
                                <a href="admin-info/index.php" class="btn btn-primary btn-custom">CHANGE ADMIN INFO</a>
                                <a href="upload/index.php" class="btn btn-primary btn-custom">UPLOAD FILE</a>
                                <input style="margin-top: 10px;" type="submit" name="clear"  class="login" value="<?php echo $rowlimit['log'];?>">
                                    <?php
                                    if (isset($_POST['clear'])){
                                        mysqli_query($connn,"UPDATE user SET log='0'");
                                    }
                                    ?>

                                <input type="submit" name="logout" value="LOGOUT" class="input-custom">
                                <?php
                                    if (isset($_POST['logout'])){
                                        mysqli_query($connn,"UPDATE user SET cookie='NOTSET'");
                                        session_destroy();
                                    }
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
