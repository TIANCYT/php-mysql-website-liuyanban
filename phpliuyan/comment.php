<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
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
if(!isset($_SESSION['username']))
{
    echo "<script>alert('请先登录！');location='login.php';</script>";
    exit(0);
}

?>
<center><h2>写评论</h2></center>
<form action="write_comment.php" method="post">
    内&nbsp;&nbsp;容:<br />
    <textarea name="comment_msg" cols="60" rows="20"></textarea><br />
    <input type="submit" name="submit" value="评论" />
</form>
<a href="viewcomment.php">查看评论</a>
<br />
<a href = "logout.php">注销</a>
</body>