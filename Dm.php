<?php

$host = '127.0.0.1';
$port = 3306;

$user = 'root';
$pass = 'root';
$db = '1910php';

$dbh = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$dbh->query("set names utf8");

$sql = "select goods_id,goods_name,shop_price from p_goods limit 10";
$res = $dbh->query($sql);
$data = $res->fetchAll(PDO::FETCH_ASSOC);


echo '<pre>';print_r($data);echo '</pre>';





