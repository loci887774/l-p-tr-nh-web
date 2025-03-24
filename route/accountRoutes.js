let express = require('express');

let router = express.Router();

let accountController = require('../controllers/accountController');

router.get('/account', accountController.handleAccount);

//Hiển thị form để người dùng chỉnh sửa thông tin.
router.get('/account/update', accountController.getUpdateForm);
//Xử lý form sau khi người dùng nhấn nút Cập nhật.
router.post('/account/update', accountController.postUpdate);


module.exports = router;