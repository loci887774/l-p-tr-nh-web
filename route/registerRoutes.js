//nạp framework express
let express = require('express');

let db = require('../db');

//sử dụng hàm router để tìm tuyến đường xử lý dữ liệu
let router = express.Router();

//nạp module custom
let registerController = require('../controllers/registerController');

router.post('/register', registerController.handleRegister);

router.post('/check-email', (req, res) => {
    const { email } = req.body;
  
    const sql = 'SELECT * FROM sinhviennodejs WHERE email = ?';
    db.query(sql, [email], (err, results) => {
      if (err) {
        console.error('Lỗi truy vấn:', err);
        return res.status(500).json({ error: 'Lỗi server' });
      }
  
      if (results.length > 0) {
        res.json({ exists: true });
      } else {
        res.json({ exists: false });
      }
    });
  });

//thực thi biến router, dữ liệu sẽ được xử lý
module.exports = router;