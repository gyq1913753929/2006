<?php
    //接收参数
    $id = $_GET['id'];

    //查数据库
    $status = true;
    
    if($status)
    {
        $response = [
            'errno' =>0,
            'msg' =>'ok'
        ];
    }else{
        $response = [
            'errno' =>400006,
            'msg' =>'已被预定'
        ];
    }
    die(json_encode($response));
