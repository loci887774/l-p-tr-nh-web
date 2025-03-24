exports.handleLogout = (req, res) => {
    if (req.session.email) {
        req.session.destroy((err) => {
            if (err) {
                console.log('lỗi xóa ss', err);
            } else {
                res.redirect('/login');
            }
        })
    }
};

