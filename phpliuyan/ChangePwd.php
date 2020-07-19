<?php
session_start();
if(!isset($_SESSION['username']))
{
    echo "<script>alert('请先登录！');location='login.php';</script>";
    exit(0);
}
?>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<a href = "OwnPage.php">返回上一页</a>
<br/>
<form action="CheckChangePwd.php" method="post" >
    原  密  码 ：<input type="password" name="password_old"/>
    <br/>
    新  密  码 ：<input type="password" name="password_new"/> <font size="2" face="arial" color="red">*长度不少于8位且只允许数字、字母和下划线</font>
    <br/>
    <input type="Submit" name="Submit" value="确定"/>
    <br/>
</form>
</body>