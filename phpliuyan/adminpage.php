<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
</head>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<?php
session_start();
$fromurl="//localhost:63342/phpliuyan/adminpage.php/"; //跳转往这个地址。
if( @$_SERVER['HTTP_REFERER'] == "" )
{
    //header("Location:".$fromurl);
    $_SESSION = array(); //清除SESSION值.
    if(isset($_COOKIE['name'])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.
        setcookie('name','',time()-1,'/');
    }
    session_destroy();  //清除服务器的sesion文件
    echo "<script>alert('请登录管理员账号！');location='login.php';</script>";
    exit(0);
}
/*if(!defined('IN_SYS')) {
    $_SESSION = array(); //清除SESSION值.
    if(isset($_COOKIE['name'])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.
        setcookie('name','',time()-1,'/');
    }
    session_destroy();  //清除服务器的sesion文件
    echo "<script>alert('请登录管理员账号！');location='login.php';</script>";
    exit(0);
}*/
if(!isset($_SESSION['username']))
{

    echo "<script>alert('请先登录！');location='login.php';</script>";

    exit(0);
}
if(isset($_SESSION['expiretime'])) {
    if($_SESSION['expiretime'] < time()) {
        unset($_SESSION['expiretime']);
        $_SESSION = array(); //清除SESSION值.
        if(isset($_COOKIE['name'])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.
            setcookie('name','',time()-1,'/');
        }
        session_destroy();  //清除服务器的sesion文件
        echo "<script >alert('登录超时，请重新登录！' );location='login.php';</script>";
        exit(0);
    } else {
        $_SESSION['expiretime'] = time() + 60; // 刷新时间戳
    }
}
?>
<center><table style="border:dotted">
        <caption>用户发表内容</caption>
        <tr><th>用户</th><th>标题</th><th>发表时间</th></tr>
        <?php
        @mysql_connect("localhost","root","tiancy");   //连接数据库
        mysql_select_db("tiancyDb");  //选择数据库
        mysql_query("set names 'utf-8'"); //设定字符集
        $q = "select * from messagelist";//设置查询指令
        $result = mysql_query($q);//执行查询
       // $id=$row["id"];
        while($row = mysql_fetch_assoc($result)){
            echo "<tr><td>".$row["username"]."</td><td>".$row["title"]."</td><td>".$row["lastdate"]."</td> <td> <a href=\"adminview.php?id=".$row['id']."\">查看</a></td><td><a href=\"delete.php?id=".$row['id']."\">删除</a></td></tr>";
        }
        ?>
    </table><br />
    <a href="logout.php">注销</a>
</center>
</body>
</html>