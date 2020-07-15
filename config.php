<?php
/**
 * Created by PhpStorm.
 * Author: https://www.fengxiaopeng.cn
 * Date: 2020/7/13
 * Time: 14:50
 */

define("HOST", 'smtp.qq.com');  //邮箱的服务器地址
define("DEBUG", 0); //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
define("PORT", 465);    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
define("CHARSET", 'UTF-8'); //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
define("FROMNAME", '');    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
define("USERNAME", '');    //smtp登录的账号 如果是QQ邮箱这里填入字符串格式的qq号即可
define("PASSWORD", '');     //smtp登录的密码 使用生成的授权码 你的最新的授权码
define("FROM", '');     //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”