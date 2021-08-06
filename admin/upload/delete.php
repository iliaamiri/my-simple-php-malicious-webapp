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
    $id=$_GET['id'];
    if (!preg_match("/^[0-9]*$/",$id)){
        header("location:index.php?letters_id");
    }
    else{
        $conn = mysqli_connect($host,$user,$pass)or die(mysqli_error());
        mysqli_select_db($conn,$db);
        $sql=mysqli_query($conn,"SELECT * FROM upload_tbl WHERE id='$id'");
        $row = mysqli_fetch_assoc($sql);
        mysqli_query($conn,"DELETE FROM upload_tbl WHERE id='$id'");
        unlink("$row[url]");
        $conn->close();
        header("location:list.php?deleted");
    }
?>
