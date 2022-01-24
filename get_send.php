<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
</head>
<body>
   <h1>GETでデータを送信する</h1>
   <p>名前と住所を入力してください</p>
   <form action="get_receive.php" method="GET">
      <label>名前</label>
      <input type="text" name="name"><br>
      <label>住所</label>
      <input type="text" name="address"><br>
      <input type="submit" value="送信する">
   </form>
</body>
</html>
