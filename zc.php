<?php


include "pdo.php";
$pdo = getPdo();

$user_name = $_POST['username'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2  =$_POST['pass2'];

// 判断 两次密码是否一制
if($pass1!==$pass2)
{
    $response = [
        'errno'=> 400001,
        'msg'=>'两次密码不一制'
    ];
    die(json_encode($response));
}

//验证密码长度>6
if(strlen($pass1)<6)
{
    $response = [
        'errno' => 400002,
        'msg'=>'密码长度太短'
    ];
    die(json_encode($response));

}

    //验证用户是否存在
   
    $sql = "select * from p_users where user_name='$user_name'";

    $res = $pdo->query($sql);
    $data= $res->fetch(PDO::FETCH_ASSOC);
    //找到记录
    if($data)
    {
        $response = [
            'errno' => 400010,      // 用户名已存在
            'msg'   => "用户名已存在"
        ];
        die( json_encode($response));
    }


    //手机号是否存在
    $sql = "select * from p_users where mobile='$mobile'";

    $res = $pdo->query($sql);
    $data= $res->fetch(PDO::FETCH_ASSOC);
    //找到记录
    if($data)
    {
        $response = [
            'errno' => 400011,      // 手机号已存在
            'msg'   => "手机号已存在"
        ];
        die( json_encode($response));
    }

    //邮箱是否存在
    $sql = "select * from p_users where email='$email'";

    $res = $pdo->query($sql);
    $data= $res->fetch(PDO::FETCH_ASSOC);
    //找到记录
    if($data)
    {
        $response = [
            'errno' => 400012,      // 邮箱已存在
            'msg'   => "邮箱已存在"
        ];
        die( json_encode($response));
    }




    //信息入库
    //生产密码
    $password = password_hash($pass1,PASSWORD_BCRYPT);
    $sql = "insert into p_users (user_name,email,mobile,password,reg_time)values ('$user_name','$email','$mobile','$password','$reg_time')";
    $pdo->exec($sql);       //执行SQL
    $id = $pdo->lastInsertId(); //获取自增ID
    if($id>0){  //入库成功
        $response = [
            'errno' => 0,
            'msg'   => 'ok',
        ];
       
    }else{      //入库失败
        $response = [
            'errno' => 500008,
            'msg'   => '注册失败，请重试'
        ];
    }
    header("2006.com/login.html");
    echo json_encode($response);