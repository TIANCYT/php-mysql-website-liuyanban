<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>浏览留言</title>
</head>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<center><h2>留言内容</h2></center>
<center><table border="1">
        <?php
        session_start();
        {
            echo "<script>alert('请先登录！');location='login.php';</script>";
            exit(0);
        }
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
        $_SESSION['id']=$_GET['id'];
        $q = "select MSG from messagelist where id =  ".$_SESSION['id']." ";//设置查询指令
        $result = mysql_query($q);//执行查询
        if($row = mysql_fetch_assoc($result)){
            echo "<tr><td>".$row["MSG"]."</td></tr>";
        }
        ?>
    </table><br />
    <a href="adminpage.php">返回</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="adminviewcomment.php">查看评论</a>

</center>
</body>
</html>