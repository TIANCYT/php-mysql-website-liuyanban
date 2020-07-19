<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
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
<a href="ViewOwnMessage.php">我的文章</a>
<br />
<a href="ViewOwnComments.php">我的评论</a>
<br />
<a href="ViewGotComments.php">收到的评论</a>
<br />
<a href="ChangePwd.php">更改密码</a>
<br />
<a href="firstpage.php">返回上一页</a>
<br />
</body>