<?php
    session_start();
    include "pdo.php";

    $pdo = getPdo();
    
    $sql = "select * from p_rooms";
    $res = $pdo ->query($sql);
    $data = $res->fetchAll(PDO::FETCH_ASSOC);
?>












<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery-3.5.1.min.js"></script>
    <style>
        #app {
            width: 400px;
        }

        .divs {
            width: 100px;
            height: 100px;
            border: 1px solid #eeeeee;
            background-color: #3598db;
            margin: 10px;
            float: left;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="divs" data-id="100"><button class="btn">可预定 ￥111</button>100</div>
        <div class="divs" data-id="101"><button class="btn">可预定 ￥112</button>101</div>
        <div class="divs" data-id="102"><button class="btn">可预定 ￥113</button>102</div>
        <div class="divs" data-id="103"><button class="btn">可预定 ￥114</button>103</div>
        <div class="divs" data-id="104"><button class="btn">可预定 ￥115</button>104</div>
        <div class="divs" data-id="105"><button class="btn">可预定 ￥116</button>105</div>

    </div>

    <script>
        $(".btn").on('click',function(){
           
            var id = $(this).parent().attr("data-id")      //获取房间号
            var self = $(this)

            if (confirm("确定预定吗？")) {
                $.ajax({
                    url: 'dz.php',
                    method: 'get',
                    data: { id: id },
                    dataType: 'json'
                }).done(function (res) {
                    console.log(res)
                    if(res.errno==0){
                        console.log("预定成功")
                        self.parent().css("background-color","red")
                    }
                })
            }
        })





    </script>
</body>

</html>