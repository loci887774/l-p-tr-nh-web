<!DOCTYPE html>
<html>
<head>
    <title>Lab2-bài 1: Calendar</title>

    <style>
        table {
            border-collapse: collapse;
            width: 300px;
        }
        tr, td {
            border: 1px solid black;
            width: 40px;
            height: 40px;
            text-align: center;
        }
    </style>

</head>

<body>
    <h2>Select a Month/Year Combination</h2>
    <form method="GET">
        <select name="month">
            <?php
            //-----------------------------------------------------------------------
            //|tháng hiện tại bằng tháng do người dùng chọn? nếu không sẽ là tháng hiện tại
            //|isset($_GET['month']): kiểm tra xem người dùng đã chọn ftháng nào từ form chưa
            //|nếu isset($_GET['month']) == true thì lấy giá trị month từ URL
            //|nếu isset($_GET['month']) == false thì lấy giá trị tháng hiện tại
            //-----------------------------------------------------------------------

                $currentMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
                $months = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                //-----------------------------------------------------------------------
                //|index: stt của các phần từ trong tháng, value: giá trị tháng từ 1-12
                //|vòng lặp foreach: lặp qua từng phần tử trong mảng month
                //|foreach ($months as $index => $month) {
                //-----------------------------------------------------------------------
                for($i = 0; $i < count($months); $i++){
                    $value = $i + 1;
                    $selected = ($value == $currentMonth) ? "selected" : "";
                    echo "<option value = '$value' $selected>$months[$i]</option>";
                    //đoạn trên tương đương với đoạn mã này trong HTML
                    //<option value="1">January</option>
                }
            ?>
        </select>

        <select name="year">
            <?php
                $currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
                for ($y = date('Y') - 10; $y <= date('Y') + 10; $y++) {
                    $selected = ($y == $currentYear) ? "selected" : "";
                    echo "<option value='$y' $selected>$y</option>";
                }
            ?>
        </select>

        <button type="submit">Go!</button>
    </form>

    <?php
    //lấy giá trị của name = month và name = year
    if (isset($_GET['month']) && isset($_GET['year'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];

        //$months[$month - 1]: chú ý month và monthS
        //month là giá trị của bộ chọn select name = month, có gtri từ 1-12 thôi, vaule đã sử lí chỉ số 0 rồi
        //bản thân value phải đưa về 1-12 thì mới so sánh được với $currentMonth được
        //monthS là giá trị của mảng, mà chỉ số trong mảng bắt đầu từ 0 nên khi 
        //truyền month vào thì phải -1 đi để lấy đúng chỉ số 
        // dấu . là phép nối chuỗi trong PHP
        echo "<h3>Calendar for " . $months[$month - 1] . " $year</h3>";

        //mktime(hour, minute, second, month, day, year) tạo ra một timestamp của ngày đầu tiên trong tháng.
        //Ở đây, ta lấy 0 giờ, 0 phút, 0 giây của ngày 1 trong tháng $month của năm $year
        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        //date('t', $firstDay) trả về số ngày trong tháng $month của $year.
        $daysInMonth = date('t', $firstDay);
        //date('w', $firstDay) trả về thứ của ngày đầu tiên trong tháng (0 là Chủ Nhật, 6 là Thứ Bảy).
        $startDay = date('w', $firstDay); 

        echo "<table>";
        echo "<tr>
                <td>Sun</td>
                <td>Mon</td>
                <td>Tue</td>
                <td>Wed</td>
                <td>Thu</td>
                <td>Fri</td>
                <td>Sat</td>
              </tr>";

        echo "<tr>";
        //tạo ô trống cho các ngày trong tuần trước ngày bắt đầu của tháng đó
        for ($i = 0; $i < $startDay; $i++) {
            echo "<td></td>";
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            //điều kiện xuống dòng
            if (($day + $startDay - 1) % 7 == 0 && $day != 1) {
                echo "</tr><tr>";
            }
            echo "<td>$day</td>";
        }

        echo "</tr>";
        echo "</table>";
    }
    ?>
</body>
</html>
