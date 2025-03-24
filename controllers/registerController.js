//controllers/registerController.js

let db = require('../db'); // kết nối CSDL
let crypto = require('crypto');

exports.handleRegister = (req, res) => {
    let {hoten, password, email, namsinh, gioitinh} = req.body;
    
    //băm mật khẩu
    let hashpwd = crypto.createHash('sha1').update(password).digest('hex');

    //câu truy vấn
    let sql = 'INSERT INTO sinhviennodejs (hoten, password, email, namsinh, gioitinh) value (?,?,?,?,?)';

    //gọi hàm truy vấn
    db.query(sql, [hoten, hashpwd, email, namsinh, gioitinh], (err, result) =>{
        console.log('họ tên: ', req.body.hoten);
        console.log('năm sinh: ', req.body.namsinh);
        console.log('giới tính: ', req.body.gioitinh);
        if(err) {
            console.error('lỗi khi thêm dữ liệu: ', err);
            res.status(500).send('Lỗi server 😢');
            return;
        }
        console.log('thêm người dùng thành công!');
        res.redirect('/login');
    })
};