// MySQL2モジュールをインポート
const mysql = require('mysql2');

// MySQLデータベースに接続
const connection = mysql.createConnection({
  host: 'localhost',        // MySQLサーバーのホスト名
  user: 'root',             // ユーザー名
  password: '',             // パスワード（必要に応じて設定）
  database: 'prost'         // データベース名
});

// データベースに接続
connection.connect((err) => {
  if (err) {
    console.error('データベースへの接続エラー: ', err);
    return;
  }
  console.log('MySQLに接続成功');
  
  // クエリを実行
  connection.query('SELECT * FROM userdata', (err, results, fields) => { // テーブル名をuserに修正
    if (err) {
      console.error('クエリエラー: ', err);
      return;
    }
    
    // クエリ結果を表示
    console.log('クエリ結果: ', results);

    // 接続を閉じる
    connection.end();
  });
});
