<?php 
include_once ("config.php");
if (isset($_POST['login']))
{
    $connn = mysqli_connect($host,$user,$pass)or die("Error in connect via Sqli");
    mysqli_select_db($connn,$db);
    $sqllimit = mysqli_query($connn,"SELECT log FROM user WHERE id='1'");
    $rowlimit = mysqli_fetch_assoc($sqllimit);
    if ($rowlimit['log'] > 30){
        mysqli_query($connn,"UPDATE user SET status='0'");
        header("location:index.php?ERROR=Password_LIMITED");
    }
    try{
        @$username=$_POST['username'];
        if (!preg_match("/^[a-zA-Z0-9_.@]*$/",$username)){
            header("location:index.php?letters");
        }
        else{
            $conn= new PDO("mysql:host=$host;dbname=$db",$user,$pass);
            $sql=$conn->prepare("SELECT * FROM user WHERE username='$username'");
            $sql->execute();
            foreach ($sql->fetchAll() as $row){
                $pas=$_POST['password'];
                if (!preg_match("/^[a-zA-Z0-9_.@]*$/",$pas)){
                    header("location:index.php?letters_p");
                }
                else{
                    $salt = 'SUPER_SALTY';
                    $password=md5($pas.$salt);
                    if ($password == $row['password']) {
                        if ($row['status'] == '2') {
                            $cookie_value = $row['password'].md5($row['password'],$salt).rand([20000],[100000]).md5($username,$salt);
                            setcookie('admin', $cookie_value, time() + (300 * 1), '/');
                            try{
                                $connection = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
                                $sqlcookie = $connection->prepare("UPDATE user SET cookie='$cookie_value'");
                                $sqlcookie->execute();
                                $_SESSION['name'] = $row['password'];
                                header("location:admin/index.php?cookie_set");
                            }
                            catch (PDOException $e){
                                header("location:AN_ERROR_OCCURRED");
                            }
                        } else {
                            die("No Access");
                        }
                    } else {
                        $i = $rowlimit['log'] + 1;
                        mysqli_query($connn, "UPDATE user SET log='$i'");
                        header("location:index.php?login=wrong-password");
                    }
                }
            }
        }
    }
    catch (PDOException $e){
        echo 'error';
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/icon.gif" type="image/gif" sizes="16x16">
    <!-- <link href="css/main.css" type="text/css" rel="stylesheet">-->
    <link href="css/login.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
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

                                    <input type="text" placeholder="Username" class="input" name="username"/>
                                    <input type="password" placeholder="Password" class="input" name="password"/>
                                    <input type="submit" value="Login" class="login" name="login">
                                    <p>
                                        <?php
                                        if (isset($_GET['ERROR'])=="Password_LIMITED")
                                            echo '<h1 style="color: red;">!PASSWORD LOCKED!</h1>';
                                        if (isset($_GET['login']) =="wrong-password")
                                            echo '<b style="color: red;">Wrong Password</b>';
                                        ?>
                                    </p>
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
