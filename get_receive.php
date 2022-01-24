<?php
	if(isset($_GET['name']) && isset($_GET['address'])){
	    $name = $_GET['name'];
	    $address = $_GET['address'];
	}
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
</head>
<body>
   <h1>受信ページ</h1>
   <p>あなたの名前は<?php echo $name;?>さんです。</p>
   <p>あなたの住所は<?php echo $address;?>です。</p>
</body>
</html>
