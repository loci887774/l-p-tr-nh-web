<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buổi 1 php</title>
</head>
<body>
<?php
    // echo "hello ";

    // khai báo biến
    // $name = 'đu'; 
    // echo "my name is $name";

    // biến toàn cục

    //ghép chuỗi
    // $name2 = ' xấu xí';
    // $sum = $name.$name2;
    // echo " and $sum";

    //foreach: duyệt qua từng phần tử của mảng
    $colors = array("red", "green", "blue", "yellow");
    // foreach ($colors as $x) {
    // echo "$x <br>"; 
    // }

    // cookies
   
    // Cài đặt cookie có tên "user" và giá trị là "John Doe", hết hạn sau 1 ngày (24 * 3600 giây)
    // setcookie("user", "John Doe", time() + 86400, "/"); // "/": cookie này có hiệu lực trên toàn bộ trang web

    // echo "Cookie đã được cài đặt!";

    // if(isset($_COOKIE["user"])) {
    //     echo "Xin chào, " . $_COOKIE["user"]; 
    // } else {
    //     echo "Không có cookie 'user'.";
    // }

    //mảng
    // $cars_0 = ["Volvo", "BMW", "Toyota"];


    echo date(format:'d-m-y');
    
    
?>
</body>
</html>