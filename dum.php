<?php
    include "pdo.php";

    $pdo = getPdo(); 

    $username = $_GET['name'];
   
    //查询数据库
    $sql = "select * from p_users where user_name='user_name'";
    $res = $pdo->query($sql);
    $data = $res->fetch(PDO::FETCH_ASSOC);
    if($data){
        $response=[
        'errno'=>'400012',
        'msg'=>'用户也存在'
        ];
    }else{
        $response = [
            'errno' =>'0',
            'msg'=>'ok'
        ];
    }

    echo json_encode($response);


