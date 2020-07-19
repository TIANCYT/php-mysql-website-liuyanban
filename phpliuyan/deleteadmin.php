<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
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
header("content-type:text/html;charset=utf-8");
@mysql_connect("localhost","root","tiancy");   //连接数据库
mysql_select_db("tiancyDb");  //选择数据库
$id=$_GET['id'];
$sql="delete from memberlist where id = $id";
$que=mysql_query($sql);
if($que){
    echo"<script>alert('删除成功，返回列表');location.href='admindelete.php';</script>";
}else{
    echo "<script>alert('删除失败')</script>";
    exit;
}
?>