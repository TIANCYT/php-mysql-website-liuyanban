<?php
$servername = "localhost";
$username = "root";
$password = "tiancy";
$dbname = "tiancyDb";

// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
echo "连接成功";
// 使用 sql 创建数据
/*$sql = "CREATE TABLE memberlist(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
class INT(5) default 0,
lastdate  TIMESTAMP
)";*/
$sql="UPDATE memberlist SET username='tian'
WHERE username='tiancy'";
if ($conn->query($sql) === TRUE) {
    echo "created successfully";
} else {
    echo "插入数据表: " . $conn->error;
}
?>