var f = document.forms[0]

var name = f.username.value

f.addEventListener('submit', function (ev) {
    ev.preventDefault()


    var inputs = f.getElementsByTagName("input")
    console.log(inputs)

    var send_str = ""
    for (var i = 0; i < inputs.length; i++) {

        if (inputs[i].getAttribute("name") == null) {
            continue
        }


        var k = inputs[i].getAttribute("name")
        var v = inputs[i].value
        send_str += k + "=" + v + "&"
    }
    console.log(send_str)

    new_str = send_str.substring(0, send_str.length - 1)





    //通过Ajax 将表单的数据发送给服务器
    //1实例化        
    xhr = new XMLHttpRequest();

    //2监听readystate ==4
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //接收服务器的响应服务
            var json_str = xhr.responseText
            console.log(json_str)

            var data = JSON.parse(json_str)
            if (data.errno == 0) {
                alert('ok')
            } else {
                alert('失败')
            }
        }
    }

    //3open
    xhr.open("POST", "login.php")
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")

    //4 send
    xhr.send(new_str)
})

