<?php
//ob_clean(); // Xóa mọi output trước đó
//ob_start(); // Bắt đầu buffer output để tránh lỗi
require_once("../mysqlConnect.php"); //chổ này gây cho dl hình ảnh không còn thuần túy khi gửi lên brownser
file_put_contents("buffer_log_showimage.txt", ob_get_contents());
$mysqli->select_db("bookstore");
try{
    if(!isset($_REQUEST['book_id'])) {
        echo "<br>Tôi không có ảnh để hiển thị nếu bạn không nhập ID ảnh lên URL";
        exit();
    }else{
        $book_id=$_REQUEST["book_id"];
        $stm = $mysqli->prepare("SELECT * FROM images WHERE book_id = ?");
        $stm->bind_param("i", $book_id);
        if($stm->execute()){
            $img = $stm->get_result()->fetch_assoc();
            // Ghi dữ liệu ảnh ra file để kiểm tra
            file_put_contents("test_image.jpg", $img['image_data']);
            // Kiểm tra có dữ liệu rác không
            if (ob_get_length() > 0) {
                file_put_contents("buffer_log.txt", ob_get_contents());
            }
            // Xóa toàn bộ buffer để đảm bảo không có dữ liệu rác
            ob_clean();
            header("Content-Type: ".$img["mime_type"]);
            header("Content-Length: ".$img["file_size"]);
            echo $img['image_data'];
            //ob_end_flush(); // Đảm bảo chỉ dữ liệu ảnh được gửi đi ngay lập tức
            exit();
        }else {
            echo "Error: ".$stm->error;
        }
    }
}catch(Exception $exception){
    echo "Ops! Something went wrong loading the image: ".$exception->getMessage();
}
?>
