<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>查看评论</title>
</head>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<center><table style="border:dotted">
        <tr><th>答主</th><th>评论内容</th><th>发表时间</th></tr>
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
        @mysql_connect("localhost","root","tiancy");   //连接数据库
        mysql_select_db("tiancyDb");  //选择数据库
        mysql_query("set names 'utf-8'"); //设定字符集
        $q = "select * from comments where comment_name =\"".$_SESSION['username']."\" ";//设置查询指令
        $result = mysql_query($q);//执行查询
        while($row = mysql_fetch_assoc($result)) {
            echo "<tr><td>".$row["comment_for"]."</td><td>".$row["comment_msg"]."</td><td>".$row["lastdate"]."</td><td> <a href=\"deletecomments.php?id=".@$row["id"]."\">删除</a></td></tr>";
        }
        ?>
    </table><br />
    <a href="OwnPage.php">返回上一页</a>
</center>
</body>
</html>