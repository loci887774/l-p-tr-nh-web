//nạp module http
//let http = require('http');
let stringUtils = require('./stringUtils');

console.log(stringUtils.capitalizeFirstLetter('ab'));
console.log(stringUtils.reverseString('ab'));

//tạo server và hàm callback
// http.createServer(function(req, res) {

//     //gửi header phản hồi cho trình duyệt
//     res.writeHead(200, {'Content-Type': 'text/html'});

//     //phản hồi từ server
//     res.end('Hello Kitty!');
// //server bắt đầu lắng nghe trên cổng 80    
// }).listen(80);