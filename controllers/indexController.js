exports.handleIndex = (req, res) => {
    if (req.session && req.session.email) {
        res.render('index', {username: req.session.hoten});
    } else {
        res.redirect('/login');
    }
};