<?php
//Nhúng tệp kết nối MySQL
require("../mysqlConnect.php");

//kết nối với db
$mysqli->select_db("bookstore");

$sql = "SELECT * FROM books";

//Thực hiện truy vấn và lưu kết quả vào biến $res
$res = $mysqli->query($sql);

if (!$res) {
    die("Truy vấn thất bại: " . $mysqli->error);
}

echo "<table>";
//fetch_assoc() lấy từng dòng dữ liệu dưới dạng mảng kết hợp (associative array), 
//trong đó tên cột là key của mảng.
while($row = $res->fetch_assoc()) {
    echo "<tr>";
    //Hiển thị ảnh của sách. Hàm showImage.php dùng để lấy ảnh từ CSDL và hiển thị.
    echo "<td><img src='showImage.php?book_id=" . $row['book_id'] . "' /></td>";
    echo "<td><b>".$row['title']."</b>:<br/>".$row['introduction']."<br>".$row['book_id']."</td>";
}
echo "</table>";
?>