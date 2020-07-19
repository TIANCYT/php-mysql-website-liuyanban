<script language="JavaScript">
    window.history.forward(1);
    window.focus();
</script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>查看评论</title>
</head>
<body background="bg3.jpg" style="background-repeat:no-repeat">
<center><table style="border:dotted">
        <tr><th>评论者</th><th>评论内容</th><th>发表时间</th></tr>
        <?php
        session_start();
        if(!isset($_SESSION['username']))
        {
            echo "<script>alert('请先登录！');history.go(-1);</script>";
        }
        @mysql_connect("localhost","root","tiancy");   //连接数据库
        mysql_select_db("tiancyDb");  //选择数据库
        mysql_query("set names 'utf-8'"); //设定字符集
        $q = "select * from comments where message_id =".$_SESSION['id']." ";//设置查询指令
        $result = mysql_query($q);//执行查询
            while($row = mysql_fetch_assoc($result)) {
                echo "<tr><td>".$row["comment_name"]."</td><td>".$row["comment_msg"]."</td><td>".$row["lastdate"]."</td><td> <a href=\"deletecomments.php?id=".@$row["id"]."\">删除</a></td></tr>";
            }
        ?>
    </table><br />
    <a href="adminpage.php">返回</a>
</center>
</body>
</html>