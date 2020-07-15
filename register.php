<?php
/**
 * Created by PhpStorm.
 * Author: https://www.fengxiaopeng.cn
 * Date: 2020/7/13
 * Time: 14:50
 */
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.js"></script>
</head>
<body>
<form action="">
    用户名：<input type="text" placeholder="请输入用户名"><br>
    密码：<input type="password" placeholder="请输入密码"><br>
    邮箱：<input type="text" id="mail" placeholder="请输入邮箱"><input type="button" id="fasong" value="发送邮件验证码" onclick="send()"><span id="prompt" style="color: #ff0000;"></span><br>
    邮箱验证码：<input type="text" id="input" placeholder="请输入邮箱验证码"><br>
    <input type="button" value="提交" onclick="yanzheng()" >
    <script>
        function verify(Max, Min) {
            var Range = Max - Min;
            var Rand = Math.random();
            return (Min + Math.round(Rand * Range));
        }
        function send() {
            $(function () {
                var num = verify(100000, 999999);
                // alert(num);
                var mail = $('#mail').val();
                var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
                if (mail == ""){
                    $("#prompt").html("请输入邮箱！");
                }else if(reg.test(mail)){
                    var exp = new Date();
                    exp.setTime(exp.getTime() + 60 * 1000);//设置cookie过期时间 1分钟
                    document.cookie = "veri=" + md5(num) + ";expires=" + exp.toGMTString();
                    $.ajax({
                        type: "POST",
                        data: {
                            mail: mail,
                            title: "这是您的验证码",
                            content: "您的验证码为：" + num
                        },
                        url: 'sendmail.php',
                        success: function (data) {
                            $("#fasong").attr('disabled', true);
                            $("#prompt").html(data);
                            var wait = document.getElementById('wait');
                            var interval = setInterval(function() {
                                var time = --wait.innerHTML;
                                if (time <= 0) {
                                    clearInterval(interval);
                                    //location.href = href;
                                    $("#dis").remove();
                                    $("#fasong").attr('disabled', false);
                                }
                                ;
                            }, 1000);
                        },
                        error: function (data) {
                            $("#prompt").html(data);
                        }
                    })
                }else {
                    $("#prompt").html("邮箱格式不正确，请重新输入！");
                }

            })
        }
        function getCookie(cookie_name) {
            var allcookies = document.cookie;
            //索引长度，开始索引的位置
            var cookie_pos = allcookies.indexOf(cookie_name);

            // 如果找到了索引，就代表cookie存在,否则不存在
            if (cookie_pos != -1) {
                // 把cookie_pos放在值的开始，只要给值加1即可
                //计算取cookie值得开始索引，加的1为“=”
                cookie_pos = cookie_pos + cookie_name.length + 1;
                //计算取cookie值得结束索引
                var cookie_end = allcookies.indexOf(";", cookie_pos);

                if (cookie_end == -1) {
                    cookie_end = allcookies.length;

                }
                //得到想要的cookie的值
                var value = unescape(allcookies.substring(cookie_pos, cookie_end));
            }
            return value;
        }
        function clearCookie(name) {
            document.cookie = name + "= ''";
        }
        function yanzheng() {
            var input = md5($("#input").val());
            // var arrstr = document.cookie.split("; ");
            veri = getCookie('veri');
            // console.log(veri);
            if (input === veri){
                alert('验证成功！');
                clearCookie('veri');
                console.log(getCookie('veri'));
            } else {
                alert('验证码错误！');
            }
        }
    </script>
</form>
</body>
</html>