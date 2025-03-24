//nạp framework express
let express = require('express');

//sử dụng hàm router để tìm tuyến đường xử lý dữ liệu
let router = express.Router();

//nạp module custom
let loginController = require('../controllers/loginController');

//tuyến đường xử lý dữ liệu tại /login thông qua hàm handleLogin của file loginController
router.post('/login', loginController.hanldeLogin);

//thực thi biến router, dữ liệu sẽ được xử lý
module.exports = router;