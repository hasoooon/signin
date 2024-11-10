<?php
session_start();
include_once('inc/connections.php');
if(isset($_POST['phone']) && isset($_POST['password'])){
$phone = stripcslashes(htmlspecialchars(strtolower($_POST['phone'])));
$password = stripcslashes(htmlspecialchars($_POST['password']));
$md5_pass = md5($password);
if(isset($_POST['keep'])){
    $keep = stripcslashes(htmlspecialchars($_POST['keep']));
    if($keep ==1){
        setcookie('phone',$phone,time()+3600,'/');
        setcookie('password',$password,time()+3600,'/');
    }
}
if(empty($phone)){
    $user_error = '<p id="error">الرجاء ادخال رقم الهاتف</p>';
    $err_s = 1;
}
if(empty($password)){
    $pass_error = '<p id="error">الرجاء ادخال كلمه المرور</p>';
    $err_s = 1;
    include_once('index.php');
}
if(!isset($err_s)){
    $sql = "SELECT * FROM users WHERE phone='$phone' AND password='$password' AND md5_pass='$md5_pass' limit 1";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $num_rows = mysqli_num_rows($result);
    if($num_rows != 0){
        $_SESSION['phone']= $row['phone'];
        $_SESSION['id']= $row['id'];
        header('Location:home/index.html');
        exit();

    }else{
        $user_error = '<p id="error">Worng usrname or password</p><br>';
        include_once('index.php');
        exit();
    }
}
}

