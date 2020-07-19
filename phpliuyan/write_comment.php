<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>评论</title>
</head>
<body>
<?php
session_start();
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
        $_SESSION['expiretime'] = time() + 600; // 刷新时间戳
    }
}
@mysql_connect("localhost","root","tiancy");   //连接数据库
mysql_select_db("tiancyDb");  //选择数据库
mysql_query("set names 'utf-8'"); //设定字符集
$q = "insert into comments(comment_for,message_id,comment_name,comment_msg,lastdate) values('".$_SESSION['who']."','".$_SESSION['id']."','".$_SESSION['username']."','".$_POST["comment_msg"]."',now())";//设置执行的SQL指令
$result = mysql_query($q);//执行SQL指令
if($result && mysql_affected_rows()>0)
{
    echo "评论成功！";
}
else{
    echo "评论失败！<br />";
}
//利用mysql_affected_rows()判断是否添加成功
?>
<br /><br /><br />
<form action="viewcomment.php" method="post">
    <input type="submit" name="submit" value="点击查看评论" />&nbsp;&nbsp;&nbsp;
</form>
<form action="firstpage.php" method="post">
    <input type="submit" name="submit" value="点击返回" />
</form>
</body>