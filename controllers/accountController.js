//kết nối db
const e = require('express');
let db = require('../db');

exports.handleAccount = (req, res) => {
    if (req.session && req.session.email) {

        let email = req.session.email;

        let sql = 'SELECT * FROM sinhviennodejs WHERE email = ?';

        db.query(sql, [email], (err, result) => {
            if (err) {
                console.log('Lỗi truy vấn', err);
                res.status('500').send('Lỗi server');
                return;
            } else {
                console.log('dữ liệu đã được hiển thị tại trang account');
                let user = result[0];
                res.render ('account', { //render sẽ gửi dữ liệu qua account
                    hoten: user.hoten,
                    email: user.email,
                    namsinh: user.namsinh,
                    gioitinh: user.gioitinh
                });
            }
        }); 
    } else {
        res.redirect('/login');
    }      
};


exports.getUpdateForm = (req, res) => {
    res.redirect('/update');
};

exports.postUpdate = (req, res) => {
    let email = req.session.email;
    let hoten = req.body.hoten;
    let namsinh = req.body.namsinh;
    let gioitinh = req.body.gioitinh;

    let sql = 'UPDATE sinhviennodejs SET hoten = ?, namsinh = ?, gioitinh = ? WHERE email = ?';

    db.query(sql, [hoten, namsinh, gioitinh, email], (err, result) => {
        if (err) {
            res.status(500).send('Lỗi cập nhật thông tin');
            console.log('Lỗi cập nhật thông tin', err);
            return;
        } else {
            console.log('Thông tin đã được cập nhật!');
            console.log('email: ', email);
            console.log('họ tên: ', hoten);
            console.log('năm sinh: ', namsinh);
            console.log('giới tính: ', gioitinh);
            // let user = result[0];
            // res.render ('account', { //render sẽ gửi dữ liệu qua account
            //     hoten: user.hoten,
            //     namsinh: user.namsinh,
            //     gioitinh: user.gioitinh
            // });
            res.redirect('/account');
        }
    });
};