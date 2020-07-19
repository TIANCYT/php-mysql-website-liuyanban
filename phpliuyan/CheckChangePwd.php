<?php
session_start();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data,ENT_QUOTES);
    return $data;
}
if(isset($_POST["Submit"]) && $_POST["Submit"] == "确定")
{
    $psw_old = md5(test_input($_POST["password_old"]));
    $psw_new = md5(test_input($_POST["password_new"]));
    if($psw_old == "" || $psw_new == "")
    {
        echo "<script>alert('信息有误，请重新填写！');location='ChangePwd.php' ;</script>";
    }
    else if (!preg_match("/^[a-zA-Z0-9_]*$/",$_POST["password_new"])) {
        echo "<script>alert('信息有误，请重新填写！'); location='ChangePwd.php' ;</script>";
    }
    else if(strlen(test_input($_POST["password_new"]))<8)
    {
        echo "<script>alert('信息有误，请重新填写！'); location='ChangePwd.php' ;</script>";
    }
    else
    {
       @mysql_connect("localhost","root","tiancy");
        mysql_select_db("tiancyDb");
        mysql_query("set names 'utf-8'");
        $sql0 = "select password  from memberlist where username ='".$_SESSION['username']."'";
        $result0 = mysql_query($sql0);
        if($row = mysql_fetch_assoc($result0)){
            $_SESSION['psw']=$row["password"];
        }
        if($psw_old==$_SESSION['psw'])
        {
           $sql="UPDATE memberlist SET password= '$psw_new' WHERE username=\"".$_SESSION['username']."\" ";
            $result = mysql_query($sql);
            if ($result) {
                unset($_SESSION['expiretime']);
                $_SESSION = array(); //清除SESSION值.
                if(isset($_COOKIE['name'])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.
                    setcookie('name','',time()-1,'/');
                }
                session_destroy();  //清除服务器的sesion文件
                echo "<script>alert('更改成功！'); location='login.php';</script>";
                exit(0);
            }
            else {
                echo $_SESSION['username'];
                echo $result0;
                echo $psw_old;
            }

        }
        else
        {
            echo $_SESSION['username'];
           //echo "<script>alert('信息有误，请重新登录！');history.go(-1);</script>";
        }
    }
}
else
{
    echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}
?>
