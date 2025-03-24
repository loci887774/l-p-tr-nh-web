//tải mysql npm install mysql

let mysql = require('mysql'); 

let connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'users'
});

connection.connect((err) => {
    if (err) throw err;
    console.log('kết nối db thành công!');
});

module.exports = connection; 