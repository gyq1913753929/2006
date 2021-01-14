// email input 失去焦点
document.getElementById("email").addEventListener('blur',function(){
    if(this.value == "")
    {
        return
    }
    var email = this.value
    ajax(email,this)
})



//mobile input 失去焦点
document.getElementById("mobile").addEventListener('blur',function(){
    if(mobile=="")
    {
        return
    }
    var mobile = this.value
    
    ajax(mobile,this)
})
    
   




//失去焦点  获取input值
document.getElementById("username").addEventListener('blur',function(){
   
    var username = this.value

    if(username=="")
    {
        return 
    }
    ajax(username,this)
})




function ajax(parse,node)
{
    //发送ajax请求 查询当前用户名是否可用
    var xhr  = new XMLHttpRequest();        //  1  实例化

    xhr.onreadystatechange =function(){
        if(xhr.readyState==4 && xhr.status==200)
        {
            //接收服务器的响应服务
            var json_str = xhr.responseText
            console.log(json_str)

            //判断错误码
           var data = JSON.parse(json_str)
           if(data.errno>0)
           {
               alert(json_str.msg)
               self.value=""    //清除input
               self.focus()     //获取焦点
           }
        }
    }
 
    //3  open
    xhr.open("GET","dum.php?name="+username);
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded")

    //4 send
    xhr .send()
}
