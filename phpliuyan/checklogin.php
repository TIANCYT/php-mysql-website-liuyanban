<?php
session_start();
ini_set('session.gc_maxlifetime', 300); //设置SESSION过期时间
// 定义变量并设置为空值
$username = $password = $code = "";
$sys=1;

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data,ENT_QUOTES);
  return $data;
}
//获取用户真实IP
function getIp(){
    $onlineip='';
    if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){
        $onlineip=getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){
        $onlineip=getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){
        $onlineip=getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){
        $onlineip=$_SERVER['REMOTE_ADDR'];
    }
    return $onlineip;
}
$ip = getIp();
 if(isset($_POST["submit"]) && $_POST["submit"] == "登陆") {
     if (@$_SESSION[$ip] < 3) {
     $username = test_input($_POST["username"]);
     $password = md5(test_input($_POST["password"]));
     $code = test_input($_POST["code"]);//验证码
     if ($username == "" || $password == "") {
         @$_SESSION[$ip] = @$_SESSION[$ip] + 1;//累积登录错误次数
         echo "<script>alert('信息有误，请重新登录！'); location='login.php';</script>";
         exit(0);
     }
     else if ($code != @$_SESSION['authcode'] || $code == "") {
         @$_SESSION[$ip] = @$_SESSION[$ip] + 1;//累积登录错误次数
         echo "<script >alert('信息有误，请重新登录！' );location='login.php';</script>";
         exit(0);

     } else {
            @mysql_connect("localhost", "root", "tiancy");
             mysql_select_db("tiancyDb");
             mysql_query("set names 'utf-8'");
             $username = mysql_real_escape_string($_POST[username]);//防止简单的sql注入
             $sql0 = "select username,password ,class from memberlist where username = '$username' and password = '$password' and class =0";
             $sql1 = "select username,password ,class from memberlist where username = '$username' and password = '$password' and class =1";
             $sql2 = "select username,password ,class from memberlist where username = '$username' and password = '$password' and class =2";
             $result0 = mysql_query($sql0);
             $num0 = mysql_num_rows($result0);
             $result1 = mysql_query($sql1);
             $num1 = mysql_num_rows($result1);
             $result2 = mysql_query($sql2);
             $num2 = mysql_num_rows($result2);
             if ($num0) {
                 if ($row = mysql_fetch_assoc($result0)) {
                     $_SESSION['class'] = $row['class'];
                 }
                 $_SESSION[$ip] = 0;//登录成功，IP登录次数归零
                 $_SESSION['username'] = $_POST["username"];
                 $_SESSION['expiretime'] = time() + 600;
                 $row = mysql_fetch_array($result1);  //将数据以索引方式储存在数组中
                 header("Location:firstpage.php");
             }
             else if ($num1) {
                 $_SESSION[$ip] = 0;//登录成功，IP登录次数归零
                 if ($row = mysql_fetch_assoc($result1)) {
                     $_SESSION['class'] = $row['class'];

                 }
                 $_SESSION['username'] = $_POST["username"];
                 $_SESSION['expiretime'] = time() + 600;
                 $row = mysql_fetch_array($result1);  //将数据以索引方式储存在数组中
                 $sys=0;
                 echo $row[0];
                 echo "登录成功！";
                 header("Location:adminpage.php");
             }
             else if ($num2) {
                 $_SESSION[$ip] = 0;//登录成功，IP登录次数归零
                 if ($row = mysql_fetch_assoc($result1)) {
                     $_SESSION['class'] = $row['class'];
                 }
                 $_SESSION['username'] = $_POST["username"];
                 $_SESSION['expiretime'] = time() + 600;
                 $row = mysql_fetch_array($result2);  //将数据以索引方式储存在数组中
                 echo $row[0];
                 echo "登录成功！";
                 header("Location:adminfirst.php");
             }
             else {
                 $_SESSION[$ip] = $_SESSION[$ip] + 1;//累积登录错误次数
                 echo "<script>alert('信息有误，请重新登录！');location='login.php';</script>";
                 exit();
             }
     }
 }
     else {
         echo "<script>alert('你已经输错3次密码，请等5分钟再试试');location='firstpage.php';</script>";
         exit(0);
     }
    }
    else
    {
        echo "<script>alert('提交未成功，请稍后登录！');location='login.php';</script>";
        exit(0);
    }
?>