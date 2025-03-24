let express = require('express');
let app = express();
let path = require('path');
let session = require('express-session');

app.set('view engine', 'ejs');
app.set('views', './views');

app.use(express.urlencoded({ extended: true }));

app.use(session({
    secret: 'b2203709',
    resave: false,
    saveUninitialized: true,
    cookie: { secure: false } // nhớ để false nếu không dùng HTTPS
}));

//lấy địa chỉ
let registerRouter = require('./route/registerRoutes');
let loginRouter = require('./route/loginRoutes');
let indexRouter = require('./route/indexRoutes');
let accountRouter = require('./route/accountRoutes');
let logoutRouter = require('./route/logoutRoutes');

//Cho phép các file tĩnh (HTML, CSS, JS, ảnh...) 
//nằm trong thư mục public được truy cập trực tiếp.
app.use(express.static('public'));

//gắn các route con vào app chính
app.use(registerRouter);
app.use(loginRouter);
app.use(indexRouter);
app.use(accountRouter);
app.use(logoutRouter);
app.use(express.json());

//hiển thị form ở /
//lấy url
app.get('/', (req, res) => {
    //Khi người dùng truy cập vào trang chủ /, 
    //Express sẽ gửi cho họ file HTML nằm tại views/register.html
    //res.sendFile(path.join(__dirname, 'views', 'register.ejs'));
    res.render('index');
});

app.get('/register', (req, res) => {
    res.render('register');
});

app.get('/login', (req, res) => {
    res.render('login');
});

app.get('/account', (req, res) => {
    res.render('account');
});

app.get('/logout', (req, res) => {
    res.render('logout');
});

app.get('/update', (req, res) => {
    res.render('update');
});

//chạy server
app.listen(3000, () => {
    console.log('Server đang chạy tại http://localhost:3000');
});