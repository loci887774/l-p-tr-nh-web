<?php
$servername = "localhost";
$username = "root";
$password = "";

$mysqli = new mysqli($servername, $username, $password);

if ($mysqli->connect_errno) {
    printf("Kết nối Database thất bại: %s\n", $mysqli->connect_error);
    exit();
}else {
    printf("Kết nối thành công. Thông tin máy chủ: %s\n", $mysqli->host_info);
    //$mysqli->close();
}
?>