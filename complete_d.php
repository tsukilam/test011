<?php
  session_start();
  require_once("functions.php");

  $delete = $_SESSION['delete'];

$dbh = db_conn();      // データベース接続
try{
    $sql = "SELECT * FROM user WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $delete, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row[id];
    $name = $row[name];
    $email = $row[email];
    $gender = $row[gender];
    
    $sql = "DELETE FROM user WHERE id = :id";  //プレースホルダ
    $stmt = $dbh->prepare($sql);                           //クエリの実行準備
    $stmt->bindValue(':id', $delete, PDO::PARAM_INT);      //バインド:プレースホルダーを埋める
    $stmt->execute();                                      //クエリの実行
    $dbh = null;                                           //MySQL接続解除
}catch (PDOException $e){
    echo($e->getMessage());
    die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>削除完了画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
       <div>
            <h1>削除完了画面</h1>
       </div>
    </header>
</div>
<hr>
<p>ＩDは <?php echo $id;?> </p>
<p>名前は <?php echo $name;?> </p>
<p>メールアドレスは <?php echo $email;?> </p>

<p>性別は <?php if( $gender === 1 ){ echo '男性'; }
		elseif( $gender === 2 ){ echo '女性'; }
		elseif( $gender === 9 ){ echo 'その他'; }
?> </p>
<p>以上のデータを削除しました。</p>
<?php  /* セッション変数クリア */
   unset($_SESSION['condition_name']);
   unset($_SESSION['delete']);
   unset($_SESSION['name']);
   unset($_SESSION['email']);
   unset($_SESSION['gender']);
?>
<form action="index.html" method="POST">
<div class="button-wrapper">
	<button type="submit" class="btn btn--naby btn--shadow">TOPに戻る</button>
</div>
</form>
<hr>
<div class="container">
    <footer>
        <p>CCC.</p>
    </footer>
</div>
</body>
</html>
