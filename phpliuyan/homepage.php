<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>发表</title>
</head>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<?php
session_start();
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
        $_SESSION['expiretime'] = time() + 600; // 刷新时间戳
    }
}
?>
<center><h2>写观点</h2></center>
<center><h3>欢迎<?php echo $_SESSION['username'];
?>！</h3></center>
<form action="write_msg.php" method="post">
    用户名:<input type="text" name="username" size="20" value="<?php echo $_SESSION['username'] ?>" readonly="readonly" /><br />
    标&nbsp;&nbsp;题:<input type="text" name="title" size="40" /><br />
    内&nbsp;&nbsp;容:<br />
    <textarea name="MSG" cols="60" rows="20"></textarea><br />
    <input type="submit" name="submit" value="提交留言" />
</form>

<a href="firstpage.php">查看留言</a>
<br />
<a href = "logout.php">注销</a>
</body>


