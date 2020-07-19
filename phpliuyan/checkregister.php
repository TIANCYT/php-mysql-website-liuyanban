<?php
session_start();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data,ENT_QUOTES);
    return $data;
}
    if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")
    {
        $user = test_input($_POST["username"]);
        $psw = md5(test_input($_POST["password"]));
        $psw_confirm = md5(test_input($_POST["confirm"]));
        if($user == "" || $psw == "" || $psw_confirm == "")
        {
            echo "<script>alert('信息有误，请重新注册！'); history.go(-1);</script>";
        }
        else if (!preg_match("/^[a-zA-Z0-9_]*$/",$user)) {
            echo "<script>alert('信息有误，请重新注册！'); history.go(-1);</script>";
        }
        else if(strlen(test_input($_POST["password"]))<8)
        {
            echo "<script>alert('信息有误，请重新注册！'); history.go(-1);</script>";
        }
        else
        {
            if($psw == $psw_confirm)
            {
                @mysql_connect("localhost","root","tiancy");   //连接数据库
                mysql_select_db("tiancyDb");  //选择数据库
                mysql_query("set names 'utf-8'"); //设定字符集
                $sql = "select username from memberlist where username = '$_POST[username]'"; //SQL语句
                $result = mysql_query($sql);    //执行SQL语句
                $num = mysql_num_rows($result); //统计执行结果影响的行数
                if($num)    //如果已经存在该用户
                {
                    echo "<script>alert('用户名已存在'); history.go(-1);</script>";
                }
                else    //不存在当前注册用户名称
                {
                    $sql_insert = "insert into memberlist(username,password) values('$user','$psw')";
                    $res_insert = mysql_query($sql_insert);
                    //$num_insert = mysql_num_rows($res_insert);
                    if($res_insert)
                    {
                        echo"<script>alert('注册成功');location.href='login.php';</script>";
echo $pswd;
                    }
                    else
                    {
                        echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
                    }
                }
            }
            else
            {
                echo "<script>alert('密码不一致！'); history.go(-1);</script>";
            }
        }
    }
    else
    {
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";
    }
?>
