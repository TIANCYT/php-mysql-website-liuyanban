<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script><?php
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
header("content-type:text/html;charset=utf-8");
@mysql_connect("localhost","root","tiancy");   //连接数据库
mysql_select_db("tiancyDb");  //选择数据库
$id=$_GET['id'];
    $sql="delete from messagelist where id = $id";
    $que=mysql_query($sql);
if($que&& $_SESSION['class']==1){
    echo"<script>alert('删除成功，返回首页');location.href='adminpage.php';</script>";
}
else if ($que&& $_SESSION['class']==0){
    echo"<script>alert('删除成功，返回首页');location.href='firstpage.php';</script>";
}
else{
    echo "<script>alert('删除失败')</script>";
    exit;
}
?>