<?php
    //接收参数
   // $id = $_GET['id'];

    //查数据库
   include "pdo.php";
   $pdo  =getPdo();

    $sql = "select * from p_rooms";
    $res = $pdo->query($sql);
    $data = $res->fetchAll(PDO::FETCH_ASSOC);
    


    
    if($data)
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
