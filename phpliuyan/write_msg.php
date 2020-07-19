<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>发表留言</title>
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
@$_SESSION['id']=$_GET['id'];
@mysql_connect("localhost","root","tiancy");   //连接数据库
mysql_select_db("tiancyDb");  //选择数据库
mysql_query("set names 'utf-8'"); //设定字符集
$q = "insert into messagelist(username,title,MSG,lastdate) values('".$_POST["username"]."','".trim($_POST["title"])."','".$_POST["MSG"]."',now())";//设置执行的SQL指令
$result = mysql_query($q);//执行SQL指令
if($result && mysql_affected_rows()>0)
{
    echo"<script>alert('留言成功');location.href='firstpage.php';</script>";
}
else{
    echo"<script>alert('留言失败，请重试！');location.href='firstpage.php';</script>";
}
//利用mysql_affected_rows()判断是否添加成功
?>
<br />
</body>