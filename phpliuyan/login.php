<?php
session_start();
if(isset($_SESSION['username']))
{
    echo "<script>alert('您已登录！');location='firstpage.php';</script>";
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
<a href="firstpage.php">返回首页</a>
<br />
<form action="checklogin.php" method="post">
    用户名：<input type="text" name="username" />
    <br />
    密&nbsp;&nbsp;  码：<input type="password" name="password" />
    <br/>
    验证码：<input type="text"  name="code" placeholder="填写验证码"  />
    <br/>
    <a style="padding:5px;" href="javascript:;" onclick="document.getElementById('captcha_img').src='yanzhengma.php?r='+Math.random()">
                <img id="captcha_img" class="passcode" border='1' src='yanzhengma.php?r=echo rand(); ?>' style="width:100px; height:42px" />
    </a>
    <br/>
    <input type="submit" name="submit" value="登陆" />
    <input type="button" name="cancel" onclick="" value="取消" />
</form>
</body>