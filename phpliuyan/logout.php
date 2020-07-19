<?php
session_start();
if(!isset($_SESSION['username']))
{
    echo "<script>alert('请先登录！');location='login.php';</script>";
    exit(0);
}
    $_SESSION = array(); //清除SESSION值.
    if(isset($_COOKIE['name'])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.
        setcookie('name','',time()-1,'/');
    }
    session_destroy();  //清除服务器的sesion文件
echo "<script >alert('注销成功，返回首页!' );location='firstpage.php';</script>";
//header("Location:firstpage.php");
?>