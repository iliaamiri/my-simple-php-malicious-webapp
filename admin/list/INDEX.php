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
        $sql=mysqli_query($conn,"SELECT * FROM user_tbl");
        if (isset($_POST['logout'])){
            session_destroy();
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Took List</title>
    <link rel="icon" href="../../img/icon.gif" type="image/gif" sizes="16x16">
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="css/main.css" type="text/css" rel="stylesheet">-->
    <link href="../../css/login.css" type="text/css" rel="stylesheet">
    <link href="../../css/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <form method="post" class="login-form">
        <div class="container-fluid">
            <input type="submit" name="logout" value="LOGOUT" class="input-custom">
            <a href="../" class="btn btn-custom btn-primary">BACK</a>
        </div>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Lastname</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Ip</th>
                    <th>Description</th>
                    <th>Kind</th>
                    <th>DELETE</th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($sql)){?>
                <tr>

                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['namee']?></td>
                        <td><?php echo $row['lastname']?></td>
                        <td><?php echo $row['username']?></td>
                        <td><?php echo $row['password']?></td>
                        <td><?php echo $row['ip']?></td>
                        <td><?php echo $row['description']?></td>
                        <td><?php echo $row['kind']?></td>
                        <td><a href="delete.php?id=<?php echo $row['id']?>">DELETE</a></td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        </section>
    </form>
</body>
</html>