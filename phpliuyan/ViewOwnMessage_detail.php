<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>浏览留言</title>
</head>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<center><h3>文章内容</h3></center>
<center><table border="1">
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
        $_SESSION['id']=$_GET['id'];
        $q = "select MSG from messagelist where id =  \"".$_SESSION['id']."\" ";//设置查询指令
        $result = mysql_query($q);//执行查询
        if($row = mysql_fetch_assoc($result)){
            echo "<tr><td>".$row["MSG"]."</td><td> <a href=\"delete.php?id=".@$row['id']."\">删除</a></td></tr>";
        }
        ?>
    </table><br />
    <a href="ViewOwnMessage.php">返回上一页</a>&nbsp;&nbsp;&nbsp;

</center>
</body>
</html>