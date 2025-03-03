<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>image_file</title>
</head>
<body>
    <?php
        //biến image_filename dùng để lấy dữ liệu từ ảnh được gửi lên trong form
        $image_filename = 'image_file';
        // isset($_FILES[$image_filename]) or die("No data to insert into bookstore database");
        if (isset($_FILES[$image_filename])) {
            $imgFile = $_FILES[$image_filename];
            echo "File uploaded successfully!";
        } else {
            echo "No data to insert into bookstore database";
        }
        //đường dẫn của file được lưu vào biến $imgFile
        //biến $_FILE tự động tạo ra mọto mảng chứa các thông tin về 
        // $_FILES['image_file'] = array(
        //     'name' => 'example.jpg',         // Tên file gốc
        //     'type' => 'image/jpeg',          // Loại file (MIME type)
        //     'tmp_name' => '/tmp/php1234.tmp', // Đường dẫn tạm
        //     'error' => 0,                    // Mã lỗi
        //     'size' => 123456                  // Kích thước file (byte)
        // );  
        $imgFile = $_FILES[$image_filename];

        //require_once là một lệnh trong PHP để nạp (import) một file khác vào chương trình.
        //Nếu file đã được nạp trước đó, nó sẽ không bị nạp lại.
        require_once("../mysqlConnect.php");
        //$mysqli là một đối tượng kết nối đến MySQL được khai báo trong mysqlConnect.php
        //select_db("bookstore") dùng để chọn cơ sở dữ liệu "bookstore" làm cơ sở dữ liệu mặc định cho các truy vấn SQL tiếp theo.
        $mysqli->select_db("bookstore");


        //khai báo các hàm----------------------------------------------------
        //hàm thêm dữ liệu vào bảng books
        function insert_books($title, $intro, $mysqli) {
            $stm = $mysqli->prepare("INSERT INTO books(title, introduction) VALUE(?,?)");
            $stm->bind_param("ss", $title, $intro);
            if($stm->execute()) {
                echo "The book was inserted! With id= ".$mysqli->insert_id;
            }else {
                echo "Error: ".$stm->error;
            }
            
            $stm->close();
        }


        //hàm kiểm tra ảnh
        function check_upload_img_file($imgFile) {
            $php_errors = array(UPLOAD_ERR_INI_SIZE => 'Maximum file sixe in php.ini exceeded',
                                //File quá lớn so với upload_max_filesize trong php.ini.
                                UPLOAD_ERR_FORM_SIZE => 'Maximum file size in HTML form exceeded',
                                //File quá lớn so với giá trị MAX_FILE_SIZE trong form.
                                UPLOAD_ERR_PARTIAL => 'Only part of the file was uploaded',
                                //File chỉ được tải lên một phần.
                                UPLOAD_ERR_NO_FILE => 'No image file selected for the book');
                                //Không có file nào được tải lên.

            ($imgFile['error']==0) or die("the server couldn't upload the image you selected due to:"
                                                        .$php_errors[$imgFile['error']]);

            //lấy đường dẫn tạm thời của tệp tin sau khi tải lên máy chủ, từ biến $_FILE
            $imgFileTmpName = $imgFile['tmp_name'];

            //kiểm tra tệp có được tải lên qua HTTP POST không
            //nếu không, chương trình dừng lại nhằm ngăn chặn cuộc tấn công giả mạo tải tệp
            is_uploaded_file($imgFileTmpName) or die('Possible file upload attack: ' . $imgFileTmpName);

            //kiểm tra có phải tệp hình ảnh không (.jpg, .jepg, .png)
            //cũng có thể dùng mime_content_type($imgFileTmpName)
            //getimagesize($imgFileTmpName) or die("The selected file is not an image file: " . $imgFileTmpName);
            $allowed_exts = ['jpg', 'jpeg', 'png'];
            $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed_exts)) {
                die("Chỉ cho phép tải lên file JPG hoặc PNG.");
            }

            if (!getimagesize($_FILES['file']['tmp_name'])) {
                die("File không phải là ảnh hợp lệ.");
            }

            //đọc toàn bộ nội dung tệp và chuyển về dạng chuỗi nhị phân để imgFileTmpName có thể đọc được
            $image_data = file_get_contents($imgFileTmpName);       
            

            // tổng kết quy trình
            // lấy đường dẫn ảnh tạm thời
            //kiểm tra phương thức tải lên của file
            //kiểm tra xem file có phải là tệp hình ảnh không
            //đọc nội dung file
            
        }



        //hàm chèn tệp hình ảnh vào DB
        function insert_image_to_db($imgFile, $mysqli) {
            //đọc nội dung tệp
            $image_data = file_get_contents($imgFile['tmp_name']) or die("File doesn't exist: ".$imgFile['tmp_name']);
            
            //lấy id của sách để liên kết với sách, 
            // chỉ áp dụng khi có auto_incremetn
            $book_id = $mysqli->insert_id;

            //chuẩn bị câu truy vấn bằng hàm prepare()
            $stm = $mysqli->prepare("INSERT INTO images(book_id, filename, mime_type, file_size, image_data)"
                                    ."VALUES(?,?,?,?,?)");
            
            //ràng buộc dữ liệu
            $stm->bind_param("issis", $book_id, $imgFile["name"], $imgFile["type"], $imgFile["size"], $image_data);

            //thực thi truy vấn
            if($stm->execute()) {
                echo "<br>Tải sách lên thành công!";
                echo "<br><a href='viewBooks.php'>Click vào đây để xem chi tiết</a>";
            }else {
                echo "Error: ".$stm->error;
            }

            //Giải phóng tài nguyên của Prepared Statement sau khi sử dụng
            $stm->close();
        }


        //thực thi hàm-----------------------------------------------------------

        //kiểm tra lỗi tải lên, loại tệp ảnh, kích thước, bảo mật
        check_upload_img_file($imgFile);

        //lưu giá trị title và introduction vào db
        if(isset($_POST["title"]) && isset($_POST["introduction"])) {
            insert_books( $_POST["title"], $_POST["introduction"], $mysqli);
        }else {
            echo "Book information is required";
            exit();
        }

        //chèn giá trị ảnh lên db
        insert_image_to_db($imgFile, $mysqli);


        
    ?>
</body>
</html>