<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
</head>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<center><table style="border:dotted">
        <caption>管理员列表</caption>
        <tr><th>管理员名称</th><th>添加时间</th></tr>
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
        @mysql_connect("localhost","root","tiancy");   //连接数据库
        mysql_select_db("tiancyDb");  //选择数据库
        mysql_query("set names 'utf-8'"); //设定字符集
        $q = "select * from memberlist where class = 1";//设置查询指令
        $result = mysql_query($q);//执行查询
        while($row = mysql_fetch_assoc($result)){
            echo "<tr><td>".$row["username"]."</td><td>".$row["lastdate"]."</td> <td> <a href=\"deleteadmin.php?id=".$row['id']."\">删除</a></td></tr>";
        }
        ?>
    </table><br />
    <a href="adminfirst.php">返回</a>
</center>
</body>
</html>