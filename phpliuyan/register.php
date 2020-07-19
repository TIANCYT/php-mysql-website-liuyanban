<?php
session_start();
if(isset($_SESSION['username']))
{
    echo "<script>alert('您已登录！');location='firstpage.php';</script>";
    exit(0);
}
?>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<a href = "login.php">返回登录</a>
<br/>
<form action="checkregister.php" method="post" >
    用  户  名 ：<input type="text" name="username"/> <font size="2" face="arial" color="red">*只允许数字、字母和下划线</font>
    <br/>
    密&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;&nbsp;：<input type="password" name="password"/> <font size="2" face="arial" color="red">*长度不少于8位且只允许数字、字母和下划线</font>
    <br/>
    确认密码：<input type="password" name="confirm"/>
    <br/>
    <input type="Submit" name="Submit" value="注册"/>
    <br/>
</form>
</body>