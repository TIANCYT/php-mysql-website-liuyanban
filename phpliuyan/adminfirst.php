<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
<body background="bg3.jpg" style="background-repeat:no-repeat">
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
        $_SESSION['expiretime'] = time() + 60; // 刷新时间戳
    }
}
if(!isset($_SESSION['username']))
{
    echo "<script>alert('请先登录！');location='login.php';</script>";
    exit(0);
}
?>
<a href="addadmin.php">添加管理员</a>
<br />
<a href="admindelete.php">删除管理员</a>
<br />
<a href="logout.php">注销</a>
<br />
</body>