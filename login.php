<?php

session_start();
include "pdo.php";

$pdo = getPdo(); 

$username = $_POST['username'];
$password = $_POST['pass1'];
//查询数据库
$sql = "select * from p_users where user_name='user_name' or password='password'";
$res = $pdo->query($sql);
$data= $res->fetch(PDO::FETCH_ASSOC);
if($data){
    if(password_verify($password,$data['password'])){
        header('location:my.html');
        exit;
    }
}


header('location:my.html');



