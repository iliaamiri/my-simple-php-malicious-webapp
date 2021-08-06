<?php include "../../config.php";
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
    session_destroy('name');
    header("location:../../index.php?errr");
}
$conn = mysqli_connect($host,$user,$pass)or die(mysqli_error());
mysqli_select_db($conn,$db);
$pastsql=mysqli_query($conn,"SELECT * FROM user WHERE status = '2'");
$r1= mysqli_fetch_assoc($pastsql);
if (isset($_POST['update'])){
    @$username = $_POST['username'];
    if (!preg_match("/^[a-zA-Z0-9+@.]*$/",$username)){
        header("location:index.php?letters_u");
    }
    else{
        $salt = 'SUPER_SALTY';
        $lastpass = md5($_POST['lastpass'].$salt);
        if ($lastpass == $r1['password']) {
            $newpass = $_POST['newpass'];
            $repeat = $_POST['repeat'];
            if ($newpass == $repeat) {
                $lastpass = md5($newpass.$salt);
                try {
                    $conn = new PDO("mysql:host=$host;dbname=$db",'root','');
                    $sql  = $conn->prepare("UPDATE user SET username='$username',password='$lastpass' WHERE id='1'");
                    $sql->execute();
                    header("location:index.php?reset_password_SUCCESS");
                } catch (PDOException $i) {
                    header("location:index.php?ERROR_SEND");
                }
            } else {
                header("location:index.php?passwords_notmatch");
            }
        } else {
            header("location:index.php?incorrect_password");
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
    <title>Change Password</title>
    <link rel="icon" href="../../img/icon.gif" type="image/gif" sizes="16x16">
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
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
    <form method="post" class="login-form">
        <div class="container">
            <div class="row lgpage-bg">
                <div class="col-md-4 col-md-push-4 form-box">
                    <div class="row">
                        <div class="login-page">
                            <div class="form">

                                <input type="text" placeholder="Username" class="input" name="username" value="<?php echo $r1['username'];?>"/>
                                <input type="password" placeholder="Current" class="input" name="lastpass"/>
                                <input type="password" placeholder="New-Password" class="input" name="newpass"/>
                                <input type="password" placeholder="Re-type" class="input" name="repeat"/>
                                <input type="submit" value="CHANGE" class="login" name="update">
                                <a href="../" class="btn btn-primary btn-custom">BACK</a>
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

