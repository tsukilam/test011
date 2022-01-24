<?php
require_once("functions.php");
define('MAXITEM',5);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST["name"])){
        if(!empty($_POST["name"])) {
            $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
            $_SESSION["condition_name"] = $_POST["name"];
        } else {
            $_SESSION["condition_name"] = $_POST["name"];
        }
    }
    $page = 1;
} elseif($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (isset($_GET['page'])) {
        $page = (int)$_GET['page'];
        $name = htmlspecialchars($_GET["name"], ENT_QUOTES, 'UTF-8');
        $_SESSION["condition_name"] = $_POST["name"];
    } else {
        $page = 1;
        $name = htmlspecialchars($_GET["name"], ENT_QUOTES, 'UTF-8');
        $_SESSION["condition_name"] = $_POST["name"];
    }

    // スタートのポジションを計算する
    if ($page > 1) {
    // 例：２ページ目の場合は、『(2 × 5) - 5 = 5』
        $start = ($page * MAXITEM) - MAXITEM;
    } else {
        $start = 0;
    }
}

$dbh = db_conn();
$data = [];

try{
    $sql = "SELECT * FROM user WHERE name like :name LIMIT :start , :page";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':page', MAXITEM, PDO::PARAM_INT);
    $stmt->execute();
    $count = 0;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
        $count++;
    }

}catch (PDOException $e){
    echo($e->getMessage());
    die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>検索結果一覧画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
       <div>
            <h1>検索結果一覧画面</h1>
       </div>
    </header>
</div>
<hr>
<p><?php echo $count;?>件表示</p>

<div class="container">
<form action="confirm_d.php" method="POST">

<table border=1>
    <tr><th>id</th><th>名前</th><th>メールアドレス</th><th>性別</th><th>削除対象</th></tr>
    <?php foreach($data as $row): ?>
    <tr>
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['email'];?></td>
    <td>
        <?php
           if ($row['gender'] === 1) {
              echo "男性";
           } elseif ($row['gender'] === 2) {
              echo "女性";
           } else {
              echo "その他";
           }
        ?>
    </td>
    <td style="text-align: center;">
        <?php echo "<input type='radio' name='delete' value='".$row['id']."'required>";?>
    </td>
    </tr>
    <?php endforeach; ?>
</table>
<p style="margin:8px;">
<p>編集するデータを選択してください</p>
<div class="button-wrapper">
    <button type="button" onclick="location.href='search_d.php'">戻る</button>
    <button type="submit" class="btn btn--naby btn--shadow">削除する</button>
</div>
</form>
</div>

<form action="" method="GET">
<div>
    <p>現在 <?php echo $page; ?> ページ目です。</p>
<?php
    $stmt = $dbh->prepare("SELECT COUNT(*) id FROM user WHERE name like :name");
    $stmt->bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
    $stmt->execute();
    $page_num = $stmt->fetchColumn();
   // ページネーションの数を取得する
   $pagination = ceil($page_num / MAXITEM);
?>
<?php 
   for ($x=1; $x <= $pagination ; $x++) {
      if($x === $page){
	      echo $x;
      } else {
          echo ' ';
	      echo '<a href=?page='. $x. '&name='. $name.'>'. $x. '</a>';
	      echo ' ';
	  }
   }
?>
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
