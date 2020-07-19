<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/8
 * Time: 10:29
 */
//include (mysql.php);
//include ("checkregister.php");
$servername = "localhost";
$username = "root";
$password = "tiancy";
$dbname = "tiancyDb";
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$sql = "INSERT INTO user (username, password)
VALUES ('tiancy', '123456')";
if ($conn->query($sql) === TRUE) {
    echo "新记录插入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>