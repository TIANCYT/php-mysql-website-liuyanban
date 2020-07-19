<?php
session_start();
ini_set('session.gc_maxlifetime', 300); //设置SESSION过期时间
$ip = getIp();
if($_SESSION[$ip] < 3){
    if(isset($_POST['password']) && $_POST['password'] == '123456'){
        $_SESSION['ok'] = 1;
        $_SESSION[$ip] = 0;//登录成功，IP登录次数归零
        header('location:?');
    }
    if(!isset($_SESSION['ok'])){
        $_SESSION[$ip] = $_SESSION[$ip] + 1;//累积登录错误次数
        exit('
        <form method="post">
            password:<input type="password" name="password" />
            <input type="submit" value="login" />
        </form>
    ');
    }

// cookie保存时间，分钟
    $lifeTime = 1800;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
}
else
{exit '你已经输错3次密码，请等5分钟再试试';}
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

?>
