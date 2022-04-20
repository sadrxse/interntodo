<?php
$page_title = "delete_done";
include("./header.php");
include("functions/controller.php");

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$controller = new Controller();
$stmt = $controller->checkData($id);
$stmt->execute();
$post_num = $stmt->fetchColumn();

//存在するとき
if($post_num==1){

$stmt = $controller->deleteData($id);
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
<?php 
//存在しないとき
} else { ?>
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