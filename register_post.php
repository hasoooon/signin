<?php
include('inc/connections.php');
if(isset($_POST['submit'])){
    $first_name = stripcslashes(strtolower($_POST['first_name'])) ; 
    $second_name = stripcslashes(strtolower($_POST['second_name'])) ; 
    $last_name = stripcslashes(strtolower($_POST['last_name'])) ; 
    $phone = stripcslashes(strtolower($_POST['phone'])) ; 
    $dad_phone = stripcslashes(strtolower($_POST['dad_phone'])) ; 
    $mom_phone = stripcslashes(strtolower($_POST['mom_phone'])) ; 
    $email = stripcslashes($_POST['email']);
    $password = stripcslashes($_POST['password']);
    if(isset($_POST['birthday_month']) && isset($_POST['birthday_day']) && isset($_POST['birthday_year'])){
        $birthday_month = (int)$_POST['birthday_month'];
        $birthday_day  = (int) $_POST['birthday_day'];
        $birthday_year = (int) $_POST['birthday_year'];
        $birthday = htmlentities(mysqli_real_escape_string($conn,$birthday_day.'-'.$birthday_month.'-'.$birthday_year)); 
    }

    $first_name  =  htmlentities(mysqli_real_escape_string($conn,$_POST['first_name']));
    $second_name  =  htmlentities(mysqli_real_escape_string($conn,$_POST['second_name']));
    $last_name  =  htmlentities(mysqli_real_escape_string($conn,$_POST['last_name']));
    $phone  =  htmlentities(mysqli_real_escape_string($conn,$_POST['phone']));
    $dad_phone =  htmlentities(mysqli_real_escape_string($conn,$_POST['dad_phone']));
    $mom_phone =  htmlentities(mysqli_real_escape_string($conn,$_POST['mom_phone']));
    $email =      htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
    $passsword  = htmlentities(mysqli_real_escape_string($conn,$_POST['password']));
    $md5_pass = md5($passsword);

if(isset($_POST['gender'])){
    $gender = ($_POST['gender']);
    $gender = htmlentities(mysqli_real_escape_string($conn,$_POST['gender']));
    if(!in_array($gender,['male','female'])){
        $gender_error = '<p id="error" >Please choose gender not a text ! <p>';
        $err_s = 1 ;

    }
}






if(empty($first_name)) {
    $first_name_error = '<p id="error" >رجاء ادخال الاسم الاول <p>';
    $err_s = 1 ;
}
elseif(filter_var($first_name,FILTER_VALIDATE_INT)){ 
    $first_name_error = '<p id="error" >ادخل اسم صحيح <p>';
    $err_s = 1 ;
}
if(empty($second_name)) {
    $second_name_error = '<p id="error" >رجاء ادخال الاسم الثاني <p>';
    $err_s = 1 ;
}
elseif(filter_var($second_name,FILTER_VALIDATE_INT)){ 
    $second_name_error = '<p id="error" >ادخل اسم صحيح <p>';
    $err_s = 1 ;
}
if(empty($last_name)) {
    $last_name_error = '<p id="error" >رجاء ادخال الاسم الاخير <p>';
    $err_s = 1 ;
}
elseif(filter_var($last_name,FILTER_VALIDATE_INT)){ 
    $last_name_error = '<p id="error" >ادخل اسم صحيح <p>';
    $err_s = 1 ;
}
if(empty($phone)) {
    $phone_error = '<p id="error" >رجاء ادخال رقم الهاتف<p> ';
    $err_s = 1 ;
}
if(empty($dad_phone)) {
    $dad_phone_error = '<p id="error" >رجاء ادخال رقم الاب<p> ';
    $err_s = 1 ;
}
if(empty($mom_phone)) {
    $mom_phone_error = '<p id="error" >رجاء ادخال رقم الام<p> ';
    $err_s = 1 ;
}
if(empty($email)) {
    $email_error = '<p id="error" >رجاء ادخال الايميل<p> ';
    $err_s = 1 ;
}
elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
    $email_error = '<p id="error" >ادخل ايميل صحيح <p>';
    $err_s = 1 ;

}

if(empty($gender)){
    $gender_error = '<p id="error" >الرجاء اختيار الجنس<p> ';
    $err_s = 1 ;
}
if(empty($birthday)){
    $birthday_error = '<p id="error" >الرجاء اختيار تاريخ الميلاد<p> ';
    $err_s = 1 ;
}
if(empty($passsword)){
    $pass_error = '<p id="error" >الرجاء ادخال كلمه المرور<p>';
    $err_s = 1 ;
    include('register.php');

}elseif(strlen($passsword) < 6){
    $pass_error = '<p id="error" >الحد الادني للحروف هي 8  <p> ';
    $err_s = 1 ;
    include('register.php');
}
else{
    if(($err_s == 0) && ($num_rows == 0)){
        if($gender == 'male'){
            $picture = 'no-male.png';
        }elseif($gender == 'female'){
            $picture = 'no-female.png';
        }
        $sql = "INSERT INTO users(first_name,second_name,last_name,phone,dad_phone,mom_phone,email,password,birthday,gender,md5_pass) 
        VALUES ('$first_name','$second_name','$last_name','$phone','$dad_phone','$mom_phone','$email','$passsword','$birthday','$gender','$md5_pass')";
        mysqli_query($conn,$sql);
        header('location:index.php');
    }else{
        include('register.php');
    }
}

}








?>