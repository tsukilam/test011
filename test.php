<?php
require_once("functions.php");
$dbh = db_conn();
try{
    $sql = "SELECT * FROM user;";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['id']."\t | ".$row['name']."\t | ".$row['age']."<br />";
    }
}catch (PDOException $e){
    echo($e->getMessage());
    die();
}
?>
