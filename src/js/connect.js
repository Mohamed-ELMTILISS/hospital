var mysql = require('mysql');


var con = mysql.createConnection({
    host: "127.0.0.1",
    user: "root",
    password: "",
    database: "reception_hopital"
});

con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    con.query("select * from utilisateur", function(err, result, fields) {
        if (err) throw err;
        console.log(result);
    })
})