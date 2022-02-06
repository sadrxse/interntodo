<?php
$page_title = "create_done";
include("./header.php");

$title = $_POST['title'];
$content = $_POST['content'];

$dsn = 'mysql:dbname=posts;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'INSERT INTO posts(title,content) VALUES (?,?)';
$stmt = $dbh->prepare($sql);
$stmt->bindValue(1,$title,PDO::PARAM_STR);
$stmt->bindValue(2,$content,PDO::PARAM_STR);
$stmt->execute();

$dbh = null;
?>

<div class="container">
  <div class="alert alert-success" role="alert" style="margin-top:30px;">
    <h4 class="alert-heading">ToDo added</h4>
    <hr>
    <p class="mb-0"><a href="index.php">Top</a></p>
  </div>
</div>

</body>
</html>