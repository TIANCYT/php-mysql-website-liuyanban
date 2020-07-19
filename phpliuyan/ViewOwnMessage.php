<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>我的文章</title>
</head>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<center><h2>我的文章</h2></center>
<center><table border="1">
        <tr><th>标题</th><th>   发表时间</th></tr>
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
        {
            echo "<script>alert('请先登录！');location='login.php';</script>";
            exit(0);
        }
        @mysql_connect("localhost","root","tiancy");   //连接数据库
        mysql_select_db("tiancyDb");  //选择数据库
        mysql_query("set names 'utf-8'"); //设定字符集
        $q = "select *from messagelist where username =  \"".$_SESSION['username']."\"  order by id";//设置查询指令
        $result = mysql_query($q);//执行查询
        if($result)
        {
            while($row = mysql_fetch_assoc($result)){
                echo "<tr><td> <a href=\"ViewOwnMessage_detail.php?id=".$row['id']."\">".$row['title']."</a></td><td>".$row["lastdate"]."</td></tr>";
            }
        }
        else{
            echo "没有文章";
        }
        ?>
    </table><br />
    <a href="OwnPage.php">返回上一页</a>&nbsp;&nbsp;&nbsp;

</center>
</body>
</html>