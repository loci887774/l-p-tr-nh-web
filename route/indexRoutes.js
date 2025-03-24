let express = require('express');

let router = express.Router();

//nạp module costom
let indexController = require('../controllers/indexController');

//vạch đường xử lý dữ liệu
router.get('/index', indexController.handleIndex);

module.exports = router;