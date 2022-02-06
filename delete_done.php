<?php
$page_title = "delete_done";
include("./header.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$dsn = 'mysql:dbname=posts;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//削除するToDoが存在するかの確認
$sql = "SELECT COUNT(*) FROM posts WHERE id=? AND title=? AND content=?";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(1,$id,PDO::PARAM_INT);
$stmt->bindValue(2,$title,PDO::PARAM_STR);
$stmt->bindValue(3,$content,PDO::PARAM_STR);
$stmt->execute();
$post_num = $stmt->fetchColumn();

//存在するとき
if($post_num==1){

$sql = 'DELETE FROM posts WHERE id=?';
$stmt = $dbh->prepare($sql);
$stmt->bindValue(1,$id,PDO::PARAM_INT);
$stmt->execute();

$dbh = null;

?>
<div class="container">
    <div class="alert alert-success" role="alert" style="margin-top:30px;">
        <h4 class="alert-heading">ToDo deleted</h4>
        <hr>
        <p class="mb-0"><a href="index.php">Top</a></p>
    </div>
</div>

<!-- 存在しないとき -->
<?php } else { ?>
    <div class="container">
    <div class="alert alert-success" role="alert" style="margin-top:30px;">
        <h4 class="alert-heading">No such ToDo found</h4>
        <hr>
        <p class="mb-0"><a href="index.php">Top</a></p>
    </div>
</div>
<?php } ?>

</body>
</html>