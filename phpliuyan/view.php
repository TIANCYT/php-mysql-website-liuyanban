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
            @mysql_connect("localhost","root","tiancy");   //连接数据库
            mysql_select_db("tiancyDb");  //选择数据库
            mysql_query("set names 'utf-8'"); //设定字符集
            $_SESSION['id']=$_GET['id'];
            $q = "select MSG from messagelist where id =  \"".$_SESSION['id']."\" ";//设置查询指令
            $q1 = "select username from messagelist where id =  \"".$_SESSION['id']."\" ";//设置查询指令
            $result = mysql_query($q);//执行查询
            $result1 = mysql_query($q1);//执行查询
            if($row = mysql_fetch_assoc($result)){
                echo "<tr><td>".$row["MSG"]."</td></tr>";
            }
        if($row = mysql_fetch_assoc($result1)){
            $_SESSION['who']=$row["username"];
        }
        ?>
    </table><br />
    <a href="firstpage.php">返回</a>&nbsp;&nbsp;&nbsp;
    <a href="comment.php">评论</a>&nbsp;&nbsp;&nbsp;
    <a href="viewcomment.php">查看评论</a>

</center>
</body>
</html>