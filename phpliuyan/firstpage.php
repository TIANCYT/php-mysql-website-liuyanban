<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>首页</title>
</head>

<html>
<body>

<body background="bg3.jpg" style="background-repeat:no-repeat">
<center><table style="border:dotted">
        <caption>社区首页 <br/> <br/></caption>
        <tr><th>用户</th><th>标题</th><th>    发表时间</th></tr>
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
        @mysql_connect("localhost","root","tiancy");   //连接数据库
        mysql_select_db("tiancyDb");  //选择数据库
        mysql_query("set names 'utf-8'"); //设定字符集
        $id=1;
        $q = "select * from messagelist order by id";//设置查询指令
        $result = mysql_query($q);//执行查询
            while($row = mysql_fetch_assoc($result)){
                echo "<tr><td>".$row["username"]."</td><td>".$row["title"]."</td><td>".$row["lastdate"]."</td><td> <a href=\"view.php?id=".$row['id']."\">查看</a></td></tr>";
            }
        ?>
    </table><br />
    <a href="OwnPage.php">我的主页</a>&nbsp;&nbsp;&nbsp;
    <a href="homepage.php">写观点</a>&nbsp;&nbsp;&nbsp;
    <a href="login.php">登录</a>&nbsp;&nbsp;&nbsp;
    <a href="register.php">注册</a>&nbsp;&nbsp;&nbsp;
    <a href="logout.php">注销</a>
</center>
</body>
</html>