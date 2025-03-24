// kết nối CSDL
let db = require('../db');

//nạp hàm băm
let crypto = require('crypto');

//định tên hàm và các giá trị đầu vào
exports.hanldeLogin = (req, res) => {
    //lấy dữ liệu từ form đăng ký lưu vào biến
    let email = req.body.email;
    let password = req.body.password;

    //băm mật khẩu ra để so sánh với db
    let hashpwd = crypto.createHash('sha1').update(password).digest('hex');

    //soạn câu truy vấn select
    let sql = 'SELECT * FROM sinhviennodejs WHERE email = ?';

    //gọi hàm truy vấn để kiểm tra xem thông tin đăng nhập có đúng không
    db.query(sql, [email], (err, result) => {
        if (err) {
            console.log('lỗi truy vấn dữ liệu: ', err);
            res.status(500).send('Lỗi server 😢');
            return;
        }

        //kiểm tra email có tồn tại trong db
        if (result.length === 0) {
            res.send('Thông tin không hợp lệ!');
        } else {
            let user = result[0];

            if (user.password === hashpwd) {
                console.log('Session object:', req.session);
                
                //Lưu email vào session
                req.session.loggedin = true;
                req.session.email = user.email;
                res.redirect('/index');
            } else {
                res.send('Thông tin không hợp lệ');
            }
        }

    });
};






