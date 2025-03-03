<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Object</title>
</head>
<body>
<?php

//THỪA KẾ TRONG PHP
    // Lớp cha (Superclass)
    class Person {
        protected $name;
        protected $age;

        // Constructor của lớp Person
        public function __construct($name, $age) {
            $this->name = $name;
            $this->age = $age;
        }

        // Phương thức hiển thị thông tin cơ bản
        public function showInfo() {
            echo "Họ và tên: " . $this->name . "<br>";
            echo "Tuổi: " . $this->age . "<br>";
        }
    }

    // Lớp con (Subclass) kế thừa từ lớp Person
    class Employee extends Person {
        private $position;
        private $salary;

        // Constructor của lớp Employee (gọi lại constructor của lớp cha)
        public function __construct($name, $age, $position, $salary) {
            parent::__construct($name, $age); // Gọi constructor của lớp cha
            $this->position = $position;
            $this->salary = $salary;
        }

        // Ghi đè (Override) phương thức showInfo để hiển thị thêm thông tin nhân viên
        public function showInfo() {
            parent::showInfo(); // Gọi phương thức từ lớp cha
            echo "Chức vụ: " . $this->position . "<br>";
            echo "Mức lương: $" . $this->salary . "<br>";
        }
    }

    // Tạo đối tượng Employee
    $employee1 = new Employee("Nguyễn Văn A", 30, "Lập trình viên", 2000);

    // Gọi phương thức hiển thị thông tin
    $employee1->showInfo();


    //------------------------------------
    //LỚP ẢO ABSTRACT TRONG PHP





    //INTERFACE
 
    // Định nghĩa Interface PaymentGateway
    interface PaymentGateway {
        public function processPayment($amount);
    }

    // Lớp PayPal triển khai PaymentGateway
    class PayPal implements PaymentGateway {
        public function processPayment($amount) {
            echo "Thanh toán $amount bằng PayPal.<br>";
        }
    }

    // Lớp CreditCard triển khai PaymentGateway
    class CreditCard implements PaymentGateway {
        public function processPayment($amount) {
            echo "Thanh toán $amount bằng Thẻ tín dụng.<br>";
        }
    }

    // Sử dụng các lớp triển khai
    $paypal = new PayPal();
    $paypal->processPayment(100);

    $creditCard = new CreditCard();
    $creditCard->processPayment(200);



    //-----------------------------------------
    //to_string()
        class Student
    {
        private $hoten;
        private $mssv;

        public function __construct($hoten, $mssv){
            $this->hoten = $hoten;
            $this->mssv = $mssv;
        }

        public function get_hoten() { return $this->hoten; }
        public function get_mssv() { return $this->mssv; }

        public function __toString(){
            return "Ho ten sinh vien: " . $this->get_hoten() .
                "<br/>MSSV: " . $this->get_mssv();
        }
    }

    $ob = new Student("Nguyen Van A", 12234567);
    echo $ob;


    
    
    ?>

    <!-- //-------------------------------------------
    //FORM -->
    <form action="welcome.php" name=frmDN method="post" id="frmDN">
        Name: <input type="text" name="fname"><br>
        Age: <input type="text" name="fage">
    </form>

    




</body>
</html>