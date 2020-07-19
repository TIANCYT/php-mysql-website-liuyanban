<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
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
        header('Location: logout.php?TIMEOUT'); // 登出
        exit(0);
    } else {
        $_SESSION['expiretime'] = time() + 600; // 刷新时间戳
    }
}
?>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<form action="checkaddadmin.php" method="post" >
    管理员名称 ：<input type="text" name="username"/><font size="2" face="arial" color="red">*只允许数字、字母和下划线</font>
    <br/>
    密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;&nbsp;：<input type="password" name="password"/><font size="2" face="arial" color="red">*长度不少于8位且只允许数字、字母和下划线</font>
    <br/>
    确认密码&nbsp;&nbsp;&nbsp;&nbsp;：<input type="password" name="confirm"/>
    <br/>
    <input type="Submit" name="Submit" value="添加"/>
    <br/>
    <a href = "adminfirst.php">返回上一页</a>
</form>
</body>