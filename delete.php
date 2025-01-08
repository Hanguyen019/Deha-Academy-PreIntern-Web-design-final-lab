<?php
include_once "./user.php";
if (isset($_POST['id'])){

    $id=$_POST['id'];
    User::destroy($id);
    $_SESSION['message']="Delete success";
    header("location:./");
    exit;
} else {
    $_SESSION['message']="user not found ";
    header("location:./");
    exit;
}
?>