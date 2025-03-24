let express = require('express');
let router = express.Router();

router.get('/logout', (req, res) => {
    req.session.destroy((err) => {
        if (err) {
            console.log(err);
        }
        res.redirect('/login'); // về lại trang login
    });
});

module.exports = router;
