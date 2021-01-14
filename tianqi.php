<?php
    include "pdo.php";

    $id = $_GET['id'];
    $key = 'da7e59f6465a47bb99b3c49db63c1950';

    //查询数据库是否已有记录
    $pdo = getPdo();
    $sql = "select * from p_weather where location=".$id;
    $res = $pdo->query($sql);
    $data = $res->fetch(PDO::FETCH_ASSOC);

    if ($data){//有记录
        //判断是否过期
        if ($data['expire']>time()){
            echo $data['info'];
            die();
        }
    }

    //发请求，查询天气接口
    $api_url = "https://api.2006.com/v2/city/lookup?location={$id}&{$key}&gzip=n";
    $res = file_put_contents($api_url);//获取接口返回的json数据

    //删除旧记录
    $sql = "delete from p_wearther where location=".$id;
    $pdo->exec($sql);

    //新纪录入库
    $expire = time() + 1800; //过期时间 为半小时
    $sql = "insert into p_weather (`location`,`info`,`expire`) values (${id},'{$res}',$expire)";
    $pdo->exec($sql);

    echo $res;//通过接口返回天气数据

